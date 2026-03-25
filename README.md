
# Tailwind Offline Setup

This folder contains:
- input.css  (Tailwind directives, use this to compile your full Tailwind CSS)
- tailwind.css  (a minimal precompiled CSS sample, replace with real compiled Tailwind for full usage)

## How to use

1. To build full Tailwind CSS from `input.css`, you need Node.js and Tailwind CLI installed:
   ```
   npx tailwindcss -i ./input.css -o ./tailwind.css --minify
   ```

2. Link the compiled `tailwind.css` file in your HTML or PHP:
   ```html
   <link rel="stylesheet" href="tailwind.css" />
   ```

3. Use Tailwind classes in your HTML or PHP as usual.

## Note

- The provided `tailwind.css` here is just a minimal example to show the workflow.
- For full Tailwind functionality, compile your CSS with Tailwind CLI or PostCSS.
