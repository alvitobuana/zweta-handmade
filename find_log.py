import sys
import json

sys.stdout.reconfigure(encoding='utf-8')

transcript_path = r"C:\Users\Alvito Buana\.gemini\antigravity-ide\brain\fa51641e-516e-4ebb-8211-e040e7d148a1\.system_generated\logs\transcript.jsonl"

print("Searching transcript for early WhatsApp/product images activity (line < 900)...")
with open(transcript_path, 'r', encoding='utf-8') as f:
    for idx, line in enumerate(f, 1):
        if idx >= 900:
            break
        if "WhatsApp" in line or "1781591" in line:
            print(f"\n==================== LINE {idx} ====================")
            try:
                data = json.loads(line)
                print(f"Source: {data.get('source')} - Type: {data.get('type')}")
                content = data.get('content', '')
                if content:
                    print(f"Content length: {len(content)}")
                    print(f"Content:\n{content[:1500]}")
                tcs = data.get('tool_calls', [])
                for tc in tcs:
                    print(f"Tool: {tc.get('name')}")
                    print(f"Args: {json.dumps(tc.get('args'), indent=2, ensure_ascii=False)}")
            except Exception as e:
                print(f"Error: {e}")
                print(f"Raw: {line[:500]}")
            print("-" * 50)
