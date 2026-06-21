<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $userMessage = $request->input('message');
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'reply' => 'Maaf, fitur chat AI saat ini belum dikonfigurasi. Silakan hubungi admin.'
            ]);
        }

        // Build product catalog context from database
        $products = Product::select('name', 'description', 'price', 'stock', 'status', 'category')
            ->get()
            ->map(function ($p) {
                $stokInfo = $p->stock > 0 ? "stok {$p->stock}" : "stok habis";
                return "- {$p->name} ({$p->category}): {$p->description}, Harga Rp " .
                    number_format($p->price, 0, ',', '.') .
                    ", Status: {$p->status}, {$stokInfo}";
            })
            ->implode("\n");

        $systemPrompt = <<<EOT
Kamu adalah asisten AI toko tas handmade bernama "Zweta". Tugasmu membantu pelanggan menemukan produk yang tepat sesuai kebutuhan mereka.

Berikut adalah katalog produk Zweta saat ini:
{$products}

Aturan:
- Jawab dalam Bahasa Indonesia yang ramah, santai, dan singkat (maksimal 3-4 kalimat)
- Rekomendasikan produk secara spesifik berdasarkan katalog di atas
- Jika produk stok habis, sampaikan dengan sopan dan tawarkan alternatif
- Jika pertanyaan di luar topik tas/produk Zweta, arahkan kembali ke produk
- Jangan menyebut harga yang tidak ada di katalog
- Gunakan emoji sesekali agar terasa ramah 😊
EOT;

        try {
            $response = Http::timeout(15)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
                [
                    'contents' => [
                        [
                            'role' => 'user',
                            'parts' => [
                                ['text' => $systemPrompt . "\n\nPelanggan: " . $userMessage]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 300,
                    ]
                ]
            );

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak bisa menjawab saat ini. Coba tanya lagi ya! 😊';
            } else {
                $reply = 'Maaf, ada gangguan pada layanan AI. Silakan coba beberapa saat lagi.';
            }
        } catch (\Exception $e) {
            $reply = 'Maaf, koneksi ke AI bermasalah. Silakan coba lagi nanti.';
        }

        return response()->json(['reply' => $reply]);
    }
}
