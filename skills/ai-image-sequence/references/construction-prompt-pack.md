# Construction Prompt-Pack — Nano Banana ready

Validated 12-phase German construction sequence for scroll-cinema use. Each prompt = `[Architecture-Anchor]` + `[Phase-Delta]`.

---

## Master-Anchor (paste before every Phase-Prompt)

```
REFERENCE: The attached image shows the final house. Recreate the SAME house,
SAME camera, SAME site, SAME lighting in an earlier construction phase.

THE HOUSE:
[CUSTOMIZE: describe house from the reference image — e.g.:]
Modern two-story German family home with a steep gable roof (~38° pitch)
covered in dark anthracite-brown clay tiles. L-shaped footprint: main
two-story volume on the right with a deep covered upper balcony (glass
railing with dark steel posts, string lights overhead). Single-story wing
on the left with a covered outdoor lounge area. Facade: warm off-white
smooth plaster. Window frames: matte black aluminum, floor-to-ceiling on
the ground floor of the main volume. Exposed grey concrete columns and
beam support the balcony cantilever. Concrete foundation band visible at
the base. Approximate footprint 14m × 11m. Ridge height ~8.5m.

THE SITE:
[CUSTOMIZE: describe site from the reference image — e.g.:]
Rural plot at the edge of a Rhineland village, gentle slope of mowed grass
extending to a forest tree line in the background. Single mature deciduous
tree on the left edge of the frame. Driveway in light beige gravel. Simple
stone slab path. Lavender and hydrangea borders. Approximately 800 m² lot.

THE CAMERA:
Slightly elevated aerial perspective from front-left, ~8m height, ~18m
distance, 24mm lens equivalent. House framed centrally with foreground
gravel and 30% sky. Golden hour, soft warm light from the right, slight
ground mist on the meadow.

ASPECT RATIO: 16:9. Photorealistic, fine film grain, neutral muted palette.

CRITICAL — KEEP IDENTICAL TO REFERENCE:
- House geometry, footprint, roof shape, balcony position
- Window placements and proportions
- Position of the tree on the left
- Forest tree line in the background
- Camera angle, height, distance, framing
- Light direction (warm from the right) and time of day
- Foreground gravel area
```

---

## Phase Prompts (each appends to Master-Anchor)

### Phase 01 — Grundstück & Baufeld
```
PHASE: Empty plot before construction. No house, no machinery. Just the
mowed-grass meadow, the tree on the left, the forest tree line in
background, light morning mist. Wooden surveyor stakes with red-and-white
striping mark the L-shaped footprint where the house will stand. Simple
construction site fence around the perimeter.
```

### Phase 02 — Erdarbeiten & Aushub
```
PHASE: Rectangular L-shaped foundation pit freshly excavated at the exact
footprint position. Yellow excavator parked at the edge of the pit, idle.
Piles of brown excavated soil to the right side. Construction site fence
around the perimeter. The tree on the left, the forest line in back —
both unchanged.
```

### Phase 03 — Bodenplatte & Fundament
```
PHASE: Freshly poured concrete foundation slab in the L-shaped footprint.
Steel rebar exposed at the perimeter. Wooden formwork still in place
around the edges. Fresh grey concrete surface. No walls yet. Small piles
of sand and construction material next to the slab.
```

### Phase 04 — Rohbau Erdgeschoss
```
PHASE: Ground floor walls of the reference house under construction —
about 2.2m high light-grey masonry blocks (Kalksandstein), L-shaped
layout matching the reference. Rectangular window cavities at the correct
positions matching the final design. Scaffolding starting on the right
side. No upper floor, no roof yet. Concrete columns for the balcony
already in place. Raw soil around.
```

### Phase 05 — Decke + Obergeschoss
```
PHASE: Ground floor completed with horizontal concrete ceiling slab on
top. On the main right volume, upper-floor masonry walls about 1.5m high
(the left wing stays single-story as in the reference). Full scaffolding
around the right volume. No roof yet, open sky above. Window cavities
open. The exposed concrete columns of the balcony fully visible.
```

### Phase 06 — Dachstuhl
```
PHASE: Full masonry shell completed matching the reference proportions.
Wooden roof truss being erected on the main right volume — exposed wooden
beams forming the steep gable structure (matching the reference roof
shape), no tiles yet, sky visible through the rafters. The left wing roof
being framed flat. Full scaffolding around the entire structure.
```

### Phase 07 — Dach gedeckt & Fenster
```
PHASE: Roof now fully covered with the anthracite-brown clay tiles
matching the reference. Matte black aluminum window frames installed in
all openings, including the floor-to-ceiling ground floor windows. The
balcony glass railing not yet installed. House is now weatherproof. Walls
still raw masonry — no plaster yet. Most scaffolding still up.
```

### Phase 08 — Putz & Fassade
```
PHASE: Warm off-white plaster being applied to the facade matching the
reference finish. Partial coverage — approximately 60% of the walls have
fresh plaster, 40% still show raw masonry. Most scaffolding removed, only
a ladder on one side. Roof complete with tiles, all windows installed,
exposed concrete columns visible. Raw soil around the building, no
landscaping yet.
```

### Phase 09 — Innenausbau
```
PHASE: House exterior complete — plaster clean, roof tiled, all windows
in, glass balcony railing installed. Warm yellow interior lights glowing
through several windows indicating ongoing interior work. The balcony
string lights already in place. No landscaping yet — raw soil and a few
material pallets visible around the building. Driveway not yet finished.
Dusk light to match the reference.
```

### Phase 10 — Außenanlagen
```
PHASE: House exterior fully complete. Driveway being laid in light beige
gravel. Stone slab path being installed. Garden borders being prepared —
fresh soil where lavender and hydrangeas will go. Some plants in pots
ready to be planted. Light morning, no construction debris.
```

### Phase 11 — Garten fertig
```
PHASE: All landscaping completed. Driveway done, stone path laid,
lavender and hydrangea borders in bloom. House exterior pristine.
Furniture being placed in the covered outdoor lounge area. Interior
lights warm. Day light, sun beginning to set on the right.
```

### Phase 12 — Final / Bewohnt
```
[This is the reference image itself — usually don't regenerate, but if you
must:]
PHASE: Completely finished and inhabited house. Warm interior light
glowing through windows, balcony string lights on, dog bed visible at
covered entrance, children's tricycle in front. Lavender and hydrangea in
full bloom. Golden hour, slight ground mist on the meadow. Cozy,
move-in-ready atmosphere.
```

---

## Workflow Order (BACKWARD)

```
12 → 11 → 10 → 09 → 08 → 07 → 06 → 05 → 04 → 03 → 02 → 01
```

For each frame K, attach as references:
- Frame 12 (master, geometry anchor)
- Frame K+1 (last successful, transition continuity)

---

## Negative Prompts (always add)

```
NO people unless specified, NO text overlays, NO watermarks, NO modern
equipment inappropriate for a German building site, NO changes to the
house geometry or proportions, NO drift in camera angle or framing.
```

---

## Customization for Other House Types

### For Modernist Cube/Bungalow
- Change roof: "flat roof with parapet edge"
- Change facade: "smooth concrete or anthracite plaster"
- Remove balcony if not present

### For Klassisches Satteldachhaus
- Change roof: "red clay tile gable roof, 45° pitch"
- Change facade: "white plaster with traditional details"

### For Mehrfamilienhaus
- Footprint: "rectangular 20m × 14m, 3 stories"
- Roof: "flat or low-pitched"
- Add: "multiple balconies on the upper floors"

### For Sanierung (Renovation)
- Phase 01: "existing house, dated facade and roof"
- Phase 06: "scaffolding for facade work, old plaster being removed"
- Phase 09: "new plaster on, new windows in, but old roof"
- Phase 12: "fully renovated, new roof, new facade, modern appearance"

---

## Final Output Spec

```
phase-01.jpg through phase-12.jpg
- Aspect: 16:9 (or 3:2 if cinema is wider)
- Resolution: 2400×1350 minimum, 3840×2160 ideal
- Format: JPG quality 85%
- Color: sRGB
- File size: 200–500 KB each (don't exceed 1MB)
```

Then drop them into the construction-website-builder Bauablauf section:
`/path/to/theme/assets/bauphasen/phase-01.jpg` etc.
