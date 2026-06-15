---
name: ai-image-sequence
description: "Generate consistent multi-frame image sequences with AI image generators (Nano Banana / Gemini Flow Image, Midjourney with cref, Flux, etc.) for use in scroll-driven cinema, before/after reveals, product reveals, construction time-lapses, or any animation that needs N visually-coherent frames of the same subject in different states. Provides master-anchor prompts, backward-generation workflow, drift-prevention patterns, and validated prompt-pack for German construction site phases (Grundstück → Aushub → Fundament → ... → Schlüsselübergabe). Use whenever user needs a coherent image series from an AI image tool."
---

# AI Image Sequence Generator

Generate N frames of the same subject across changing states — and have them actually look like the same subject. The 90% problem with AI image series isn't quality, it's **drift**: frame 1 has 3 trees on the left, frame 4 has 5 different trees in different positions, frame 9 looks like a different house entirely.

This skill solves that.

## When to Use

- User needs 4–24 consistent images for an animation, slideshow, or scroll-cinema
- User wants „same X in different states" (house being built, product assembled, plant growing)
- User has a reference image and wants variations that respect its geometry
- User asks „wie erzeuge ich konsistente Bauphasen-Bilder mit Gemini Flow / Nano Banana"
- Generally: image-to-image with strong consistency constraint

## The Three Rules of Image Consistency

### Rule 1 — Master Reference First, Backward Always

**Don't generate Phase 1 → 2 → 3 → ... → N. That maximizes drift.**

Do this:
1. Generate the **final frame** (most detailed) until it's perfect — that's the Master
2. Use Master as image-reference for **Frame N-1**
3. Frame N-1 as reference for N-2
4. Continue backward to Frame 1

Reasoning: the final frame is the richest (most geometry, most detail). Earlier phases are subtractions. AI is better at *removing* elements while keeping geometry than at *adding* consistent geometry from scratch.

### Rule 2 — Architecture-Anchor in Every Prompt

Every prompt has three parts:
```
[MASTER-ANCHOR: detailed geometric description, same in every prompt]
+
[CAMERA-ANCHOR: same view, same lens, same light]
+
[PHASE-DELTA: only what's different in THIS frame]
```

The Master-Anchor is 80% of the prompt — it forces the AI to recreate the same subject. The Phase-Delta is small.

### Rule 3 — Multi-Image Reference When Available

Nano Banana / Gemini Flow supports attaching **multiple reference images**. Use this:
- Master (Frame N) — always attached
- Previous successful frame (Frame K+1) — attached when generating Frame K

So when generating Phase 5, attach **both** Frame 12 (master, geometry) **and** Frame 6 (last successful, transition continuity).

## Tool-Specific Notes

### Nano Banana / Gemini Flow (recommended for sequences)
- Best at multi-reference consistency
- Supports image-to-image with up to 3 reference images
- Drag-and-drop reference images into prompt area
- Set aspect ratio explicitly (16:9 or 3:2 for cinematic)
- For German construction: works very well with detailed architectural descriptions

### Midjourney V6+ with `--cref` (character reference)
- Use `--cref [master-url] --cw 100` for max similarity
- Less control than Nano Banana on geometric structures
- Better for character/style consistency than architectural

### Flux/Krea (newer, sharp)
- Very sharp output but harder to keep consistent across frames
- Good for individual hero images, less for sequences

### DALL-E 3 (avoid for sequences)
- No reference-image support → drift is severe
- Only useful for one-off generations

## The Master-Anchor Template

```
[GENERAL ANCHOR]
[Documentary-style architectural photograph / product photograph / etc.],
[location/setting], [time of day], [light direction/quality],
[neutral muted/saturated/etc. color palette], [film grain / digital],
[aspect ratio].

[SUBJECT ANCHOR]
[Subject is X with these geometric properties]:
- [Material 1]
- [Material 2]
- [Dimension hints]
- [Specific identifying details — chimney position, roof shape, etc.]
- [Approximate scale]

[CAMERA ANCHOR]
[Camera position relative to subject], [height], [distance],
[lens equivalent], [framing], [aspect ratio].

[CRITICAL — KEEP IDENTICAL]
- [List of must-not-change elements]
- [Position of recognizable landmarks]
- [Color palette]
- [Framing]
```

Then per frame:
```
PHASE: [only the delta — what's different in this frame]
```

## Detail References

- **`references/construction-prompt-pack.md`** — Validated 12-phase German construction prompt-pack (Grundstück → Schlüsselübergabe) ready for Nano Banana
- **`references/drift-debugging.md`** — When frames start drifting: what to add to the prompt, when to regenerate, when to throw away
- **`references/format-and-export.md`** — Aspect ratios, file naming, cropping standards, JPG vs WebP

## Validated Workflow (Construction Sequence)

**For PKB-style EFH building animation (10–12 phases):**

1. **Get final reference photo** of the finished house (or generate it)
2. **Master-Anchor extraction** — write architecture description from photo:
   - Roof shape + tile color
   - Wall material + color
   - Window frames
   - Distinctive features (balcony, columns, chimney position)
   - Approximate footprint
3. **Camera-Anchor** — fix one angle:
   - „Aerial 8m height, front-left at 35°, 24mm lens, 16:9"
4. **Generate Phase 12 (= final)** as Master-Reference
5. **Loop backward** 11 → 10 → ... → 1 — attach Master + previous to each
6. **Export** all as 2400×1600 JPG (16:9) named `phase-01.jpg` through `phase-12.jpg`
7. **Drop in** to scroll-cinema (see `scroll-cinema-patterns` skill)

## Drift Detection Checklist

After generating a frame, check vs. Master:
- [ ] Same camera angle? (no shift to front-right when it should be front-left)
- [ ] Same roof shape? (gable kept its pitch, no random hip-roof appeared)
- [ ] Same proportions? (house not stretched/compressed)
- [ ] Same landmarks? (tree still on left, forest still in background)
- [ ] Same light direction? (warm-from-right doesn't become cold-from-left)
- [ ] Same color palette? (no random vibrant colors)

If **any** fail → regenerate with explicit correction in prompt:  
*„The tree on the left has moved — keep it in the exact same position as in the reference."*

## Cropping & Naming Standards

```
phase-01.jpg ... phase-12.jpg
- Aspect ratio: 16:9
- Resolution: 2400×1350 (or 1920×1080 minimum)
- Format: JPG quality 85%
- Color: sRGB
```

If frames come out in different aspect ratios from AI, **crop them all to identical 16:9** before deploying. Even 5% off-center will create visible „shifting" during the crossfade.

## Cost-Per-Sequence (rough 2026)

| Tool | Per image | 12 frames | Notes |
|---|---|---|---|
| Nano Banana / Gemini Flow Image | ~free with subscription | 0 € | Often 3 retries per phase ≈ 36 generations |
| Midjourney | ~$0.04 / image | ~$0.50 | with `--cref` for consistency |
| Flux Pro via fal.ai | ~$0.05 / image | ~$0.60 | sharp but more drift |
| DALL-E 3 | ~$0.04 / image | ~$0.50 | skip for sequences |

**Budget 2–4 hours human time** for a clean 12-frame sequence with good consistency, regardless of tool.

## Beyond Construction

Same skill works for:
- **Product unboxing** — closed box → opening → contents revealed
- **Plant growth** — seed → sprout → bloom → fruit
- **Day cycle** — same location dawn → noon → dusk → night
- **Renovation before/after** — same room in 5 stages of transformation
- **Tutorial steps** — same workspace at each stage of a build
- **Brand timeline** — same logo/storefront across decades

The recipe (master-anchor + backward-generation + multi-reference) generalizes.

## Related Skills

- **`scroll-cinema-patterns`** — for actually animating the generated sequence
- **`construction-website-builder`** — for the domain context (Bau-Sites need bauablauf-storytelling)
