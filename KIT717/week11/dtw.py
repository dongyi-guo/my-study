import time
import os
from dtaidistance import dtw
from dtaidistance import dtw_visualisation as dtwvis
import numpy as np

# Create output folder
output_dir = "dtw_charts"
os.makedirs(output_dir, exist_ok=True)

def compute_and_show(name, s1, s2, filename):
    print(f"\n{name}")
    print(f"Length s1: {len(s1)}, Length s2: {len(s2)}")

    t_ns = time.monotonic_ns()
    distance = dtw.distance(s1, s2)
    elapsed = time.monotonic_ns() - t_ns

    print(f"DTW Distance: {distance}")
    print(f"Time Taken: {elapsed / 1_000_000:.3f} ms")

    path = dtw.warping_path(s1, s2)
    filepath = os.path.join(output_dir, filename)
    dtwvis.plot_warping(s1, s2, path, filename=filepath)

# Base pattern
base_pattern = np.array([0, 0, 1, 2, 1, 0, 1, 0, 0, 2, 1, 0, 0])

# Example 1: Original
s1a = base_pattern
s2a = np.array([0, 1, 2, 3, 1, 0, 0, 0, 2, 1, 0, 0, 0])
compute_and_show("Example 1 - Original Length", s1a, s2a, "warp_len1.png")

# Example 2: Doubled length
s1b = np.concatenate([base_pattern, base_pattern])
s2b = np.concatenate([s2a, s2a])
compute_and_show("Example 2 - Doubled Length", s1b, s2b, "warp_len2.png")

# Example 3: Tripled and distorted
s1c = np.concatenate([base_pattern, base_pattern * 1.2, base_pattern])
s2c = np.concatenate([s2a * 0.8, s2a, s2a * 1.1])
compute_and_show("Example 3 - Tripled & Scaled", s1c, s2c, "warp_len3.png")

# Example 4: 5x repeated pattern
s1d = np.tile(base_pattern, 5)
s2d = np.tile(s2a, 5)
compute_and_show("Example 4 - 5x Repeated", s1d, s2d, "warp_len5.png")

# Example 5: 10x repeated + noise
np.random.seed(42)
s1e = np.tile(base_pattern, 10) + np.random.normal(0, 0.1, len(base_pattern) * 10)
s2e = np.tile(s2a, 10) + np.random.normal(0, 0.1, len(s2a) * 10)
compute_and_show("Example 5 - 10x Repeated with Noise", s1e, s2e, "warp_len10.png")
