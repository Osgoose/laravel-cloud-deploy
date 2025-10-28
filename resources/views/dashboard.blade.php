<x-layouts.app :title="__('LISTOPOLIS | MIS LISTAS')">
  <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

      {{-- Contenedor temable del shopping-app: SINCRONIZADO con Flux --}}
      <div id="shopping-app"
           data-color-scheme="light"
           x-data
           x-init="
             // Inicializa según el estado actual de Flux al cargar
             (() => {
               const isDark = !!$flux.dark;
               const appearance = $flux.appearance; // 'light' | 'dark' | 'system'
               $el.setAttribute('data-color-scheme',
                 appearance === 'light' ? 'light' :
                 appearance === 'dark' ? 'dark' :
                 (isDark ? 'dark' : 'light')
               );
             })()
           "
           x-effect="
             // Reacciona a cambios de tema en cualquier parte de la app
             (() => {
               const isDark = !!$flux.dark;
               const appearance = $flux.appearance; // 'light' | 'dark' | 'system'
               $el.setAttribute('data-color-scheme',
                 appearance === 'light' ? 'light' :
                 appearance === 'dark' ? 'dark' :
                 (isDark ? 'dark' : 'light')
               );
             })()
           "
      >
        <style>
    /* ========== SCOPE: SOLO dentro de #shopping-app ========== */
    /* Variables y tema: definidas en #shopping-app para no tocar :root global */
    /* Ocultar cualquier elemento marcado como s-hidden dentro del scope */
    #shopping-app .s-hidden { display: none !important; }

    #shopping-app {
    width: 100%;
    height: 100%;
      --color-white: rgba(255, 255, 255, 1);
      --color-black: rgba(0, 0, 0, 1);
      --color-cream-50: rgba(252, 252, 249, 1);
      --color-cream-100: rgba(255, 255, 253, 1);
      --color-gray-200: rgba(245, 245, 245, 1);
      --color-gray-300: rgba(167, 169, 169, 1);
      --color-gray-400: rgba(119, 124, 124, 1);
      --color-slate-500: rgba(98, 108, 113, 1);
      --color-brown-600: rgba(94, 82, 64, 1);
      --color-charcoal-700: rgba(31, 33, 33, 1);
      --color-charcoal-800: rgba(38, 40, 40, 1);
      --color-slate-900: rgba(19, 52, 59, 1);
      --color-teal-300: rgba(34, 197, 94, 1);
      --color-teal-400: rgba(22, 163, 74, 1);
      --color-teal-500: rgba(16, 141, 64, 1);
      --color-teal-600: rgba(14, 122, 56, 1);
      --color-teal-700: rgba(12, 104, 48, 1);
      --color-teal-800: rgba(4, 120, 87, 1);
      --color-red-400: rgba(255, 84, 89, 1);
      --color-red-500: rgba(192, 21, 47, 1);
      --color-orange-400: rgba(230, 129, 97, 1);
      --color-orange-500: rgba(168, 75, 47, 1);

      --color-brown-600-rgb: 94, 82, 64;
      --color-teal-500-rgb: 16, 141, 64;
      --color-slate-900-rgb: 19, 52, 59;
      --color-slate-500-rgb: 98, 108, 113;
      --color-red-500-rgb: 192, 21, 47;
      --color-red-400-rgb: 255, 84, 89;
      --color-orange-500-rgb: 168, 75, 47;
      --color-orange-400-rgb: 230, 129, 97;

      --color-bg-1: rgba(34, 197, 94, 0.08);
      --color-bg-2: rgba(245, 158, 11, 0.08);
      --color-bg-3: rgba(34, 197, 94, 0.08);
      --color-bg-4: rgba(239, 68, 68, 0.08);
      --color-bg-5: rgba(107, 33, 168, 0.08);
      --color-bg-6: rgba(249, 115, 22, 0.08);
      --color-bg-7: rgba(236, 72, 153, 0.08);
      --color-bg-8: rgba(34, 197, 94, 0.08);

      --color-background: var(--color-cream-50);
      --color-surface: var(--color-cream-100);
      --color-text: var(--color-slate-900);
      --color-text-secondary: var(--color-slate-500);
      --color-primary: var(--color-teal-500);
      --color-primary-hover: var(--color-teal-600);
      --color-primary-active: var(--color-teal-700);
      --color-secondary: rgba(var(--color-brown-600-rgb), 0.12);
      --color-secondary-hover: rgba(var(--color-brown-600-rgb), 0.2);
      --color-secondary-active: rgba(var(--color-brown-600-rgb), 0.25);
      --color-border: rgba(var(--color-brown-600-rgb), 0.2);
      --color-btn-primary-text: var(--color-cream-50);
      --color-card-border: rgba(var(--color-brown-600-rgb), 0.12);
      --color-card-border-inner: rgba(var(--color-brown-600-rgb), 0.12);
      --color-error: var(--color-red-500);
      --color-success: var(--color-teal-500);
      --color-warning: var(--color-orange-500);
      --color-info: var(--color-slate-500);
      --color-focus-ring: rgba(var(--color-teal-500-rgb), 0.4);
      --color-select-caret: rgba(var(--color-slate-900-rgb), 0.8);

      --focus-ring: 0 0 0 3px var(--color-focus-ring);
      --focus-outline: 2px solid var(--color-primary);
      --status-bg-opacity: 0.15;
      --status-border-opacity: 0.25;

      --select-caret-light: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23108D40' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      --select-caret-dark: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23e5f6eb' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");

      --color-success-rgb: 16, 141, 64;
      --color-error-rgb: 192, 21, 47;
      --color-warning-rgb: 168, 75, 47;
      --color-info-rgb: 98, 108, 113;

      --font-family-base: "FKGroteskNeue", "Geist", "Inter", -apple-system,
        BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      --font-family-mono: "Berkeley Mono", ui-monospace, SFMono-Regular, Menlo,
        Monaco, Consolas, monospace;
      --font-size-xs: 11px;
      --font-size-sm: 12px;
      --font-size-base: 14px;
      --font-size-md: 14px;
      --font-size-lg: 16px;
      --font-size-xl: 18px;
      --font-size-2xl: 20px;
      --font-size-3xl: 24px;
      --font-size-4xl: 30px;
      --font-weight-normal: 400;
      --font-weight-medium: 500;
      --font-weight-semibold: 550;
      --font-weight-bold: 600;
      --line-height-tight: 1.2;
      --line-height-normal: 1.5;
      --letter-spacing-tight: -0.01em;

      --space-0: 0;
      --space-1: 1px;
      --space-2: 2px;
      --space-4: 4px;
      --space-6: 6px;
      --space-8: 8px;
      --space-10: 10px;
      --space-12: 12px;
      --space-16: 16px;
      --space-20: 20px;
      --space-24: 24px;
      --space-32: 32px;

      --radius-sm: 6px;
      --radius-base: 8px;
      --radius-md: 10px;
      --radius-lg: 12px;
      --radius-full: 9999px;

      --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.02);
      --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.04), 0 1px 2px rgba(0, 0, 0, 0.02);
      --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.04),
        0 2px 4px -1px rgba(0, 0, 0, 0.02);
      --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.04),
        0 4px 6px -2px rgba(0, 0, 0, 0.02);
      --shadow-inset-sm: inset 0 1px 0 rgba(255, 255, 255, 0.15),
        inset 0 -1px 0 rgba(0, 0, 0, 0.03);
    }

    /* Dark mode preferencia del sistema, scoped */
    @media (prefers-color-scheme: dark) {
      #shopping-app {
        --color-gray-400-rgb: 119, 124, 124;
        --color-teal-300-rgb: 34, 197, 94;
        --color-gray-300-rgb: 167, 169, 169;
        --color-gray-200-rgb: 245, 245, 245;

        --color-bg-1: rgba(21, 128, 61, 0.15);
        --color-bg-2: rgba(180, 83, 9, 0.15);
        --color-bg-3: rgba(21, 128, 61, 0.15);
        --color-bg-4: rgba(185, 28, 28, 0.15);
        --color-bg-5: rgba(107, 33, 168, 0.15);
        --color-bg-6: rgba(194, 65, 12, 0.15);
        --color-bg-7: rgba(190, 24, 93, 0.15);
        --color-bg-8: rgba(16, 141, 64, 0.15);

        --color-background: var(--color-charcoal-700);
        --color-surface: var(--color-charcoal-800);
        --color-text: var(--color-gray-200);
        --color-text-secondary: rgba(var(--color-gray-300-rgb), 0.7);
        --color-primary: var(--color-teal-300);
        --color-primary-hover: var(--color-teal-400);
        --color-primary-active: var(--color-teal-800);
        --color-secondary: rgba(var(--color-gray-400-rgb), 0.15);
        --color-secondary-hover: rgba(var(--color-gray-400-rgb), 0.25);
        --color-secondary-active: rgba(var(--color-gray-400-rgb), 0.3);
        --color-border: rgba(var(--color-gray-400-rgb), 0.3);
        --color-error: var(--color-red-400);
        --color-success: var(--color-teal-300);
        --color-warning: var(--color-orange-400);
        --color-info: var(--color-gray-300);
        --color-focus-ring: rgba(var(--color-teal-300-rgb), 0.4);
        --color-btn-primary-text: var(--color-slate-900);
        --color-card-border: rgba(var(--color-gray-400-rgb), 0.2);
        --color-card-border-inner: rgba(var(--color-gray-400-rgb), 0.15);
        --shadow-inset-sm: inset 0 1px 0 rgba(255, 255, 255, 0.1),
          inset 0 -1px 0 rgba(0, 0, 0, 0.15);
        --button-border-secondary: rgba(var(--color-gray-400-rgb), 0.2);
        --color-border-secondary: rgba(var(--color-gray-400-rgb), 0.2);
        --color-select-caret: rgba(var(--color-gray-200-rgb), 0.8);
      }
    }

    /* Toggle manual por data-attr (solo dentro del scope) */
    #shopping-app[data-color-scheme="dark"] {
      --color-gray-400-rgb: 119, 124, 124;
      --color-teal-300-rgb: 34, 197, 94;
      --color-gray-300-rgb: 167, 169, 169;
      --color-gray-200-rgb: 245, 245, 245;

      --color-bg-1: rgba(21, 128, 61, 0.15);
      --color-bg-2: rgba(180, 83, 9, 0.15);
      --color-bg-3: rgba(21, 128, 61, 0.15);
      --color-bg-4: rgba(185, 28, 28, 0.15);
      --color-bg-5: rgba(107, 33, 168, 0.15);
      --color-bg-6: rgba(194, 65, 12, 0.15);
      --color-bg-7: rgba(190, 24, 93, 0.15);
      --color-bg-8: rgba(16, 141, 64, 0.15);

      --color-background: var(--color-charcoal-700);
      --color-surface: var(--color-charcoal-800);
      --color-text: var(--color-gray-200);
      --color-text-secondary: rgba(var(--color-gray-300-rgb), 0.7);
      --color-primary: var(--color-teal-300);
      --color-primary-hover: var(--color-teal-400);
      --color-primary-active: var(--color-teal-800);
      --color-secondary: rgba(var(--color-gray-400-rgb), 0.15);
      --color-secondary-hover: rgba(var(--color-gray-400-rgb), 0.25);
      --color-secondary-active: rgba(var(--color-gray-400-rgb), 0.3);
      --color-border: rgba(var(--color-gray-400-rgb), 0.3);
      --color-error: var(--color-red-400);
      --color-success: var(--color-teal-300);
      --color-warning: var(--color-orange-400);
      --color-info: var(--color-gray-300);
      --color-focus-ring: rgba(var(--color-teal-300-rgb), 0.4);
      --color-btn-primary-text: var(--color-slate-900);
      --color-card-border: rgba(var(--color-gray-400-rgb), 0.15);
      --color-card-border-inner: rgba(var(--color-gray-400-rgb), 0.15);
      --color-select-caret: rgba(var(--color-gray-200-rgb), 0.8);
    }

    #shopping-app[data-color-scheme="light"] {
      --color-brown-600-rgb: 94, 82, 64;
      --color-teal-500-rgb: 16, 141, 64;
      --color-slate-900-rgb: 19, 52, 59;

      --color-background: var(--color-cream-50);
      --color-surface: var(--color-cream-100);
      --color-text: var(--color-slate-900);
      --color-text-secondary: var(--color-slate-500);
      --color-primary: var(--color-teal-500);
      --color-primary-hover: var(--color-teal-600);
      --color-primary-active: var(--color-teal-700);
      --color-secondary: rgba(var(--color-brown-600-rgb), 0.12);
      --color-secondary-hover: rgba(var(--color-brown-600-rgb), 0.2);
      --color-secondary-active: rgba(var(--color-brown-600-rgb), 0.25);
      --color-border: rgba(var(--color-brown-600-rgb), 0.2);
      --color-btn-primary-text: var(--color-cream-50);
      --color-card-border: rgba(var(--color-brown-600-rgb), 0.12);
      --color-card-border-inner: rgba(var(--color-brown-600-rgb), 0.12);
      --color-error: var(--color-red-500);
      --color-success: var(--color-teal-500);
      --color-warning: var(--color-orange-500);
      --color-info: var(--color-slate-500);
      --color-focus-ring: rgba(var(--color-teal-500-rgb), 0.4);
      --color-success-rgb: var(--color-teal-500-rgb);
      --color-error-rgb: var(--color-red-500-rgb);
      --color-warning-rgb: var(--color-orange-500-rgb);
      --color-info-rgb: var(--color-slate-500-rgb);
    }

    /* Tipografías y bases: SOLO para el contenedor */
    #shopping-app {
      color: var(--color-text);
      background-color: var(--color-background);
      -webkit-font-smoothing: antialiased;
      font-family: var(--font-family-base);
      line-height: var(--line-height-normal);
    }

    /* Componentes: prefijo s- para evitar colisión con Tailwind y otros */
    #shopping-app .s-view { padding: var(--space-20); max-width:1200px; margin:0 auto; }
    #shopping-app .s-app-header { display:flex; flex-direction:column; gap:var(--space-24); margin-bottom:var(--space-32); }
    #shopping-app .s-app-title { font-size: var(--font-size-4xl); text-align:center; margin:0; color: var(--color-text); }
    #shopping-app .s-header-nav { display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:var(--space-16); }
    #shopping-app .s-header-actions { display:flex; gap:var(--space-8); }
    #shopping-app .s-list-header { display:flex; flex-direction:column; align-items:center; gap:var(--space-8); }
    #shopping-app .s-list-title { font-size: var(--font-size-3xl); text-align:center; margin:0; color: var(--color-text); }
    #shopping-app .s-products-count { color:var(--color-text-secondary); font-size:var(--font-size-md); background:var(--color-secondary); padding:var(--space-4) var(--space-12); border-radius:var(--radius-full); }

    #shopping-app .s-btn { display:inline-flex; align-items:center; justify-content:center; padding:var(--space-8) var(--space-16); border-radius:var(--radius-base); font-size:var(--font-size-base); font-weight:500; line-height:1.5; cursor:pointer; transition:all var(--duration-normal) var(--ease-standard); border:none; text-decoration:none; position:relative; }
    #shopping-app .s-btn:focus-visible { outline:none; box-shadow: var(--focus-ring); }
    #shopping-app .s-btn--primary { background:var(--color-primary); color:var(--color-btn-primary-text); }
    #shopping-app .s-btn--primary:hover { background:var(--color-primary-hover); }
    #shopping-app .s-btn--primary:active { background:var(--color-primary-active); }
    #shopping-app .s-btn--secondary { background:var(--color-secondary); color:var(--color-text); }
    #shopping-app .s-btn--secondary:hover { background:var(--color-secondary-hover); }
    #shopping-app .s-btn--secondary:active { background:var(--color-secondary-active); }
    #shopping-app .s-btn--outline { background:transparent; border:1px solid var(--color-border); color:var(--color-text); }
    #shopping-app .s-btn--outline:hover { background:var(--color-secondary); }
    #shopping-app .s-btn--danger { color: var(--color-error); border:1px solid var(--color-error); background:transparent; }
    #shopping-app .s-btn--danger:hover { background: rgba(var(--color-error-rgb), 0.1); }

    #shopping-app .s-lists-grid { display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: var(--space-20); }
    #shopping-app .s-list-card { background:var(--color-surface); border:1px solid var(--color-card-border); border-radius:var(--radius-lg); padding:var(--space-20); cursor:pointer; transition:all var(--duration-normal) var(--ease-standard); position:relative; }
    #shopping-app .s-list-card:hover, 
    #shopping-app .s-list-card:focus { border-color:var(--color-primary); box-shadow:var(--shadow-md); }
    #shopping-app .s-list-icon { font-size: var(--font-size-2xl); }
    #shopping-app .s-list-name { color:var(--color-text); font-size:var(--font-size-xl); margin: var(--space-12) 0; }
    #shopping-app .s-list-stats { display:flex; align-items:center; justify-content:space-between; margin-top:var(--space-16); }
    #shopping-app .s-product-count { color:var(--color-text-secondary); font-size:var(--font-size-sm); background:var(--color-secondary); padding:var(--space-4) var(--space-8); border-radius:var(--radius-base); }

    #shopping-app .s-products-list { display:flex; flex-direction:column; gap: var(--space-16); }
    #shopping-app .s-product-item { background:var(--color-surface); border:1px solid var(--color-card-border); border-radius:var(--radius-lg); padding:var(--space-16); display:flex; align-items:center; gap:var(--space-16); transition: all var(--duration-normal) var(--ease-standard); }
    #shopping-app .s-product-item:hover { border-color:var(--color-primary); box-shadow:var(--shadow-sm); }
    #shopping-app .s-product-emoji { font-size: var(--font-size-3xl); min-width:48px; text-align:center; }
    #shopping-app .s-product-info { flex:1; }
    #shopping-app .s-product-name { color:var(--color-text); font-size:var(--font-size-lg); font-weight:var(--font-weight-medium); margin-bottom:var(--space-4); }
    #shopping-app .s-product-controls { display:flex; align-items:center; gap:var(--space-12); }
    #shopping-app .s-qty-btn { display:flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:var(--radius-full); border:1px solid var(--color-border); background:var(--color-secondary); color:var(--color-text); cursor:pointer; transition: all var(--duration-fast) var(--ease-standard); font-size:var(--font-size-lg); font-weight:var(--font-weight-bold); }
    #shopping-app .s-qty-btn:hover { background:var(--color-secondary-hover); border-color:var(--color-primary); }
    #shopping-app .s-qty-display { font-size:var(--font-size-lg); font-weight:var(--font-weight-bold); color:var(--color-text); min-width:32px; text-align:center; }
    #shopping-app .s-delete-product { padding:var(--space-6); border-radius:var(--radius-base); background:transparent; border:1px solid var(--color-error); color:var(--color-error); cursor:pointer; transition: all var(--duration-fast) var(--ease-standard); font-size:var(--font-size-sm); }
    #shopping-app .s-delete-product:hover { background: rgba(var(--color-error-rgb), 0.1); }

    #shopping-app .s-empty-state { text-align:center; padding:var(--space-32); color:var(--color-text-secondary); }
    #shopping-app .s-empty-icon { font-size:64px; margin-bottom:var(--space-16); opacity:0.6; }
    #shopping-app .s-empty-state h3 { color:var(--color-text); margin-bottom:var(--space-8); }
    #shopping-app .s-empty-state p { margin:0; }

    #shopping-app .s-modal { position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.8); display:flex; align-items:center; justify-content:center; z-index:1000; padding:var(--space-20); }
    #shopping-app .s-modal.s-hidden { display:none; }
    #shopping-app .s-modal-content { background:var(--color-surface); border-radius:var(--radius-lg); border:1px solid var(--color-card-border); width:100%; max-width:500px; max-height:90vh; overflow-y:auto; }
    #shopping-app .s-modal-content--lg { max-width:700px; }
    #shopping-app .s-modal-header { display:flex; justify-content:space-between; align-items:center; padding:var(--space-20); border-bottom:1px solid var(--color-card-border-inner); }
    #shopping-app .s-modal-title { margin:0; color:var(--color-text); }
    #shopping-app .s-close-btn { width:36px; height:36px; border-radius:var(--radius-full); padding:0; display:flex; align-items:center; justify-content:center; font-size:var(--font-size-xl); font-weight:var(--font-weight-bold); border:1px solid var(--color-border); background:transparent; color:var(--color-text); }
    #shopping-app .s-modal-body { padding:var(--space-20); }
    #shopping-app .s-modal-actions { display:flex; gap:var(--space-12); justify-content:flex-end; padding:var(--space-20); border-top:1px solid var(--color-card-border-inner); margin-top:var(--space-20); }

    #shopping-app .s-form-group { margin-bottom:var(--space-16); }
    #shopping-app .s-form-label { display:block; margin-bottom:var(--space-8); font-weight:var(--font-weight-medium); font-size:var(--font-size-sm); color:var(--color-text); }
    #shopping-app .s-input, 
    #shopping-app .s-select, 
    #shopping-app .s-textarea { display:block; width:100%; padding:var(--space-8) var(--space-12); font-size:var(--font-size-md); line-height:1.5; color:var(--color-text); background-color:var(--color-surface); border:1px solid var(--color-border); border-radius:var(--radius-base); transition:border-color var(--duration-fast) var(--ease-standard), box-shadow var(--duration-fast) var(--ease-standard); }
    #shopping-app .s-input:focus, 
    #shopping-app .s-select:focus, 
    #shopping-app .s-textarea:focus { border-color:var(--color-primary); outline: var(--focus-outline); }

    #shopping-app .s-emoji-categories { display:flex; flex-wrap:wrap; gap:var(--space-6); margin-bottom:var(--space-16); border-bottom:1px solid var(--color-card-border-inner); padding-bottom:var(--space-16); }
    #shopping-app .s-category-btn { padding:var(--space-6) var(--space-12); border-radius:var(--radius-base); border:1px solid var(--color-border); background:var(--color-secondary); color:var(--color-text); cursor:pointer; transition:all var(--duration-fast) var(--ease-standard); font-size:var(--font-size-sm); white-space:nowrap; }
    #shopping-app .s-category-btn:hover { background:var(--color-secondary-hover); border-color:var(--color-primary); }
    #shopping-app .s-category-btn.s-active { background:var(--color-primary); color:var(--color-btn-primary-text); border-color:var(--color-primary); }

    #shopping-app .s-emoji-grid { display:grid; grid-template-columns: repeat(auto-fill, minmax(48px, 1fr)); gap:var(--space-8); padding:var(--space-16); background:var(--color-background); border-radius:var(--radius-base); border:1px solid var(--color-border); max-height:300px; overflow-y:auto; }
    #shopping-app .s-emoji-option { display:flex; align-items:center; justify-content:center; width:48px; height:48px; border-radius:var(--radius-base); cursor:pointer; font-size:var(--font-size-xl); transition:all var(--duration-fast) var(--ease-standard); border:2px solid transparent; }
    #shopping-app .s-emoji-option:hover { background:var(--color-secondary); transform: scale(1.1); }
    #shopping-app .s-emoji-option:focus,
    #shopping-app .s-emoji-option.s-selected { outline:none; border-color:var(--color-primary); background:var(--color-secondary); }

    #shopping-app .s-selected-emoji { margin-top:var(--space-12); padding:var(--space-8); background:var(--color-secondary); border-radius:var(--radius-base); font-size:var(--font-size-sm); color:var(--color-text); }
    #shopping-app .s-selected-emoji span:first-child { color:var(--color-text-secondary); }
    #shopping-app .s-selected-emoji-preview { font-size:var(--font-size-lg); margin-left:var(--space-8); }

    @media (max-width:768px){
      #shopping-app .s-view{ padding:var(--space-16); }
      #shopping-app .s-app-title{ font-size:var(--font-size-3xl); }
      #shopping-app .s-lists-grid{ grid-template-columns:1fr; gap:var(--space-16); }
      #shopping-app .s-list-card{ padding:var(--space-16); }
      #shopping-app .s-header-nav{ flex-direction:column; align-items:stretch; }
      #shopping-app .s-header-actions{ justify-content:center; }
      #shopping-app .s-product-item{ flex-direction:column; align-items:stretch; text-align:center; gap:var(--space-12); }
      #shopping-app .s-product-controls{ justify-content:center; }
      #shopping-app .s-modal{ padding:var(--space-12); }
      #shopping-app .s-modal-actions{ flex-direction:column; }
      #shopping-app .s-category-btn{ font-size:var(--font-size-xs); padding:var(--space-4) var(--space-8); }
      #shopping-app .s-emoji-grid{ grid-template-columns: repeat(auto-fill, minmax(40px, 1fr)); max-height:250px; }
      #shopping-app .s-emoji-option{ width:40px; height:40px; font-size:var(--font-size-lg); }
    }

    @media (max-width:480px){
      #shopping-app .s-app-title{ font-size:var(--font-size-2xl); }
      #shopping-app .s-list-title{ font-size:var(--font-size-2xl); }
      #shopping-app .s-modal-content--lg{ max-width:100%; }
      #shopping-app .s-emoji-categories{ justify-content:center; }
      #shopping-app .s-category-btn{ flex:0 0 auto; }
    }

    #shopping-app .s-btn[disabled] {
  opacity: 0.5;
  cursor: not-allowed;
  filter: grayscale(0.2);
  }

  </style>
{{-- Vista principal --}}
        <div class="s-view @if(request('list')) s-hidden @endif">
          <header class="s-app-header">
            <h1 class="s-app-title">Mis Listas</h1>

            {{-- Botón abrir modal nueva lista --}}
            <button type="button" class="s-btn s-btn--primary" data-open="#s-modal-new-list">
              <span aria-hidden="true">➕</span>&nbsp; Nueva Lista
            </button>
          </header>

          <div class="s-lists-grid" role="list">
            @forelse($lists as $list)
              @php $total = $list->products->sum('quantity'); @endphp
              <a class="s-list-card" role="listitem" href="{{ route('dashboard', ['list' => $list->id]) }}">
                <div class="s-list-icon">{{ $list->emoji ?? '📝' }}</div>
                <h3 class="s-list-name">{{ $list->name }}</h3>
                <div class="s-list-stats">
                  <div class="s-product-count">{{ $total }} artículos</div>
                </div>
              </a>
            @empty
              <div class="s-empty-state" id="s-empty-state">
                <div class="s-empty-icon">📋</div>
                <h3>No tienes listas aún</h3>
                <p>Crea tu primera lista para comenzar a organizarte</p>
              </div>
            @endforelse
          </div>
        </div>

        {{-- Vista detalle --}}
        <div class="s-view @unless(request('list')) s-hidden @endunless">
          @if($current)
            <header class="s-app-header">
              <div class="s-header-nav">
                <div class="s-header-actions">
                  <a href="{{ route('dashboard') }}" class="s-btn s-btn--outline" aria-label="Volver">
                  <span aria-hidden="true">←</span>&nbsp; Volver
                </a>
                  {{-- Abrir modal editar lista --}}
                  <button type="button" class="s-btn s-btn--secondary" data-open="#s-modal-edit-list">
                    <span aria-hidden="true">✏️</span>&nbsp; Editar
                  </button>
                  {{-- Abrir modal eliminar lista --}}
                  <button type="button" class="s-btn s-btn--danger" data-open="#s-modal-confirm-delete-list">
                    <span aria-hidden="true">🗑️</span>&nbsp; Eliminar
                  </button>
                </div>
<div class="flex flex-fil gap-2">
 @if (session('status'))
    <div class="text-sm" style="display:inline-block; margin-top:6px; color: var(--color-success);">
      {{ session('status') }}
    </div>
  @endif

  @error('email')
    <div class="text-sm" style="display:inline-block; margin-top:6px; color: var(--color-error);">
      {{ $message }}
    </div>
  @enderror
<form action="{{ route('lists.share', $current->id) }}" method="post" class="flex flex-fil gap-2" style="max-width: 480px;">
  @csrf
  <input id="share-email" type="email" name="email" class="s-input" placeholder="correo@ejemplo.com" required>
  <button type="submit" class="s-btn s-btn--secondary">Compartir</button>
</form>

@php $noShares = \App\Models\ShoppingListShare::where('shopping_list_id', $current->id)->doesntExist(); @endphp
<form action="{{ route('lists.unshareAll', $current->id) }}" method="post" class="inline-block">
  @csrf
  <button type="submit"
          class="s-btn s-btn--danger"
          @if($noShares) disabled aria-disabled="true" @endif>
    Dejar de compartir
  </button>
</form>
</div>
              </div>

              <div class="s-list-header">
                <h2 class="s-list-title">{{ ($current->emoji ?? '📝') . ' ' . $current->name }}</h2>
                <span class="s-products-count" aria-live="polite">
                  {{ $current->products->sum('quantity') }} artículos
                </span>
              </div>

              {{-- Abrir modal agregar producto --}}
              <button type="button" class="s-btn s-btn--primary" data-open="#s-modal-add-product">
                <span aria-hidden="true">➕</span>&nbsp; Agregar Producto
              </button>
            </header>

            {{-- Listado de productos --}}
            <div class="s-products-list">
              @forelse($current->products as $p)
                <div class="s-product-item">
                  <div class="s-product-emoji">{{ $p->emoji ?? '🔸' }}</div>
                  <div class="s-product-info">
                    <div class="s-product-name">{{ $p->name }}</div>
                  </div>
                  <div class="s-product-controls">
                    <form action="{{ route('products.dec', $p->id) }}" method="POST">
                      @csrf
                      <button class="s-qty-btn" aria-label="Disminuir">−</button>
                    </form>

                    <span class="s-qty-display">{{ $p->quantity }}</span>

                    <form action="{{ route('products.inc', $p->id) }}" method="POST">
                      @csrf
                      <button class="s-qty-btn" aria-label="Aumentar">+</button>
                    </form>

                    <button type="button" class="s-delete-product" aria-label="Eliminar" data-open="#s-modal-confirm-delete-{{ $p->id }}">🗑️</button>
                  </div>
                </div>

                {{-- Modal confirmar eliminar producto --}}
                <div id="s-modal-confirm-delete-{{ $p->id }}" class="s-modal s-hidden" role="dialog" aria-modal="true" aria-labelledby="s-confirm-title-{{ $p->id }}">
                  <div class="s-modal-content">
                    <div class="s-modal-header">
                      <h3 id="s-confirm-title-{{ $p->id }}" class="s-modal-title">Confirmar Eliminación</h3>
                      <button type="button" class="s-close-btn" data-close>&times;</button>
                    </div>
                    <div class="s-modal-body">
                      <p>¿Eliminar este producto?</p>
                    </div>
                    <div class="s-modal-actions">
                      <button type="button" class="s-btn s-btn--outline" data-close>Cancelar</button>
                      <form action="{{ route('products.destroy', $p->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="s-btn s-btn--danger">Eliminar</button>
                      </form>
                    </div>
                  </div>
                </div>
              @empty
                <div class="s-empty-state">
                  <div class="s-empty-icon">📦</div>
                  <h3>Esta lista está vacía</h3>
                  <p>Agrega productos para comenzar tu lista</p>
                </div>
              @endforelse
            </div>
          @endif
        </div>

        {{-- Modal: Nueva Lista --}}
<div id="s-modal-new-list" class="s-modal s-hidden" role="dialog" aria-modal="true" aria-labelledby="s-new-list-title">
  <div class="s-modal-content">
    <div class="s-modal-header">
      <h3 id="s-new-list-title" class="s-modal-title">Nueva Lista</h3>
      <button type="button" class="s-close-btn" data-close>&times;</button>
    </div>
    <form action="{{ route('shopping-lists.store') }}" method="POST">
      @csrf
      <div class="s-modal-body">
        <div class="s-form-group">
          <label for="s-new-list-name" class="s-form-label">Nombre de la lista</label>
          <input id="s-new-list-name" name="name" type="text" class="s-input" placeholder="Ej: Compras Supermercado" required>
        </div>
      </div>
      <div class="s-modal-actions">
        <button type="button" class="s-btn s-btn--outline" data-close>Cancelar</button>
        <button type="submit" class="s-btn s-btn--primary">Guardar</button>
      </div>
    </form>
  </div>
</div>
        @if($current)
          {{-- Modal: Editar Lista --}}
          <div id="s-modal-edit-list" class="s-modal s-hidden" role="dialog" aria-modal="true" aria-labelledby="s-edit-list-title">
            <div class="s-modal-content">
              <div class="s-modal-header">
                <h3 id="s-edit-list-title" class="s-modal-title">Editar Lista</h3>
                <button type="button" class="s-close-btn" data-close>&times;</button>
              </div>
              <form action="{{ route('shopping-lists.update', $current->id) }}" method="POST">
                @csrf
                <div class="s-modal-body">
                  <div class="s-form-group">
                    <label for="s-edit-list-name" class="s-form-label">Nombre de la lista</label>
                    <input id="s-edit-list-name" name="name" type="text" class="s-input" value="{{ $current->name }}" required>
                  </div>
                </div>
                <div class="s-modal-actions">
                  <button type="button" class="s-btn s-btn--outline" data-close>Cancelar</button>
                  <button type="submit" class="s-btn s-btn--primary">Guardar</button>
                </div>
              </form>
            </div>
          </div>

          {{-- Modal: Agregar Producto --}}
          <div id="s-modal-add-product" class="s-modal s-hidden" role="dialog" aria-modal="true" aria-labelledby="s-add-product-title">
            <div class="s-modal-content s-modal-content--lg">
              <div class="s-modal-header">
                <h3 id="s-add-product-title" class="s-modal-title">Agregar Producto</h3>
                <button type="button" class="s-close-btn" data-close>&times;</button>
              </div>
              <form action="{{ route('products.store', $current->id) }}" method="POST">
                @csrf
                <div class="s-modal-body">
                  <div class="s-form-group">
                    <label for="s-product-name" class="s-form-label">Nombre del producto</label>
                    <input id="s-product-name" name="name" type="text" class="s-input" placeholder="Ej: Leche" required>
                  </div>

                  <div class="s-form-group">
                    <label class="s-form-label">Seleccionar icono</label>
                    <div class="s-emoji-categories" role="tablist">
                      <button type="button" class="s-category-btn s-active" data-category="all">Todos</button>
                      <button type="button" class="s-category-btn" data-category="Comida">Comida</button>
                      <button type="button" class="s-category-btn" data-category="Animales">Animales</button>
                      <button type="button" class="s-category-btn" data-category="Objetos">Objetos</button>
                      <button type="button" class="s-category-btn" data-category="Símbolos">Símbolos</button>
                    </div>
                    <div class="s-emoji-grid" id="s-emoji-grid" role="grid" aria-live="polite"></div>
                    <input type="hidden" id="s-selected-emoji" name="emoji" />
                    <div class="s-selected-emoji">
                      <span>Icono seleccionado:</span>
                      <span id="s-selected-emoji-preview" class="s-selected-emoji-preview">Ninguno</span>
                    </div>
                  </div>

                  <div class="s-form-group">
                    <label for="s-quantity" class="s-form-label">Cantidad</label>
                    <input id="s-quantity" name="quantity" type="number" class="s-input" value="1" min="1" required>
                  </div>
                </div>
                <div class="s-modal-actions">
                  <button type="button" class="s-btn s-btn--outline" data-close>Cancelar</button>
                  <button type="submit" class="s-btn s-btn--primary">Agregar</button>
                </div>
              </form>
            </div>
          </div>


          {{-- Modal: Confirmar eliminar lista --}}
          <div id="s-modal-confirm-delete-list" class="s-modal s-hidden" role="dialog" aria-modal="true" aria-labelledby="s-confirm-delete-list-title">
            <div class="s-modal-content">
              <div class="s-modal-header">
                <h3 id="s-confirm-delete-list-title" class="s-modal-title">Confirmar Eliminación</h3>
                <button type="button" class="s-close-btn" data-close>&times;</button>
              </div>
              <div class="s-modal-body">
                <p>¿Eliminar la lista "{{ $current->name }}"?</p>
              </div>
              <div class="s-modal-actions">
                <button type="button" class="s-btn s-btn--outline" data-close>Cancelar</button>
                <form action="{{ route('shopping-lists.destroy', $current->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="s-btn s-btn--danger">Eliminar</button>
                </form>
              </div>
            </div>
          </div>
        @endif


<script>
(function () {
  // Configura aquí cada modal con su input destino
  const modalConfigs = [
    { id: 's-modal-new-list', inputId: 's-new-list-name' },
    { id: 's-modal-edit-list', inputId: 's-edit-list-name' },
    { id: 's-modal-add-product', inputId: 's-product-name' },
  ];

  const triggersMap = new Map(); // modalEl -> lastTrigger

  function focusSafely(modalEl, inputEl) {
    if (!modalEl || !inputEl) return;
    // Intento inmediato + refuerzos tras transición/animación
    requestAnimationFrame(() => {
      const tryFocus = () => {
        if (document.contains(inputEl)) inputEl.focus({ preventScroll: true });
      };
      tryFocus();
      const onEnd = () => { tryFocus(); };
      modalEl.addEventListener('transitionend', onEnd, { once: true });
      modalEl.addEventListener('animationend', onEnd, { once: true });
      setTimeout(tryFocus, 50);
    });
  }

  function isHidden(modalEl) {
    return modalEl.classList.contains('s-hidden');
  }

  function openModal(modalEl, inputEl, triggerEl) {
    if (!modalEl) return;
    triggersMap.set(modalEl, triggerEl || document.activeElement);
    modalEl.classList.remove('s-hidden');
    focusSafely(modalEl, inputEl);
  }

  function closeModal(modalEl) {
    if (!modalEl) return;
    modalEl.classList.add('s-hidden');
    const lastTrigger = triggersMap.get(modalEl);
    if (lastTrigger && typeof lastTrigger.focus === 'function') {
      lastTrigger.focus({ preventScroll: true });
    }
  }

  // Delegación de clicks: data-open="ID_DEL_MODAL" abre; data-close cierra.
  document.addEventListener('click', (e) => {
    const openBtn = e.target.closest('[data-open]');
    if (openBtn) {
      const modalId = openBtn.getAttribute('data-open');
      const cfg = modalConfigs.find(c => c.id === modalId);
      if (cfg) {
        e.preventDefault();
        const modalEl = document.getElementById(cfg.id);
        const inputEl = document.getElementById(cfg.inputId);
        openModal(modalEl, inputEl, openBtn);
        return;
      }
    }
    const closeBtn = e.target.closest('[data-close]');
    if (closeBtn) {
      // Encuentra el modal contenedor
      const modalEl = closeBtn.closest('.s-modal');
      if (modalEl) {
        e.preventDefault();
        closeModal(modalEl);
      }
    }
  });

  // Escape cierra el modal visible activo
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      const openModals = modalConfigs
        .map(c => document.getElementById(c.id))
        .filter(m => m && !isHidden(m));
      const topModal = openModals[openModals.length - 1];
      if (topModal) {
        e.preventDefault();
        closeModal(topModal);
      }
    }
  });

  // Observa cambios de clase: si un modal pasa a visible, enfoca su input
  const mo = new MutationObserver((mutations) => {
    for (const m of mutations) {
      if (m.type === 'attributes' && m.attributeName === 'class') {
        const modalEl = m.target;
        if (modalEl.classList && !isHidden(modalEl)) {
          const cfg = modalConfigs.find(c => c.id === modalEl.id);
          if (cfg) {
            const inputEl = document.getElementById(cfg.inputId);
            focusSafely(modalEl, inputEl);
          }
        }
      }
    }
  });

  modalConfigs.forEach(cfg => {
    const el = document.getElementById(cfg.id);
    if (!el) return;
    mo.observe(el, { attributes: true, attributeFilter: ['class'] });
  });
})();
</script>


{{-- JS mínimo para abrir/cerrar modals y selector de emojis (sin APIs) --}}
<script>
(function () {
  const root = document.getElementById('shopping-app');

  // ---------- Modales ----------
  root?.addEventListener('click', (e) => {
    const opener = e.target.closest('[data-open]');
    if (!opener) return;
    const sel = opener.getAttribute('data-open');
    const modal = sel ? document.querySelector(sel) : null;
    if (modal) {
      modal.classList.remove('s-hidden');
      bindEmojiUIOnce(modal);
      maybeAutoSetEmoji(modal);
    }
  });

  root?.addEventListener('click', (e) => {
    const closer = e.target.closest('[data-close]');
    if (closer) {
      const modal = closer.closest('.s-modal');
      if (modal) modal.classList.add('s-hidden');
      return;
    }
    const modalOverlay = e.target.classList?.contains('s-modal');
    if (modalOverlay) {
      e.target.classList.add('s-hidden');
    }
  });

  // ---------- Grid de emojis ----------
  const emojiCategories = {
    all: 
    ['🍇','🍉','🍊','🍋','🍌','🍍','🥭','🍎','🍏','🍐','🍑','🍒','🍓','🥝','🍅','🥥','🥑','🍆','🥔','🥕','🌽',
      '🥦','🥬','🧄','🧅','🍄','🥜','🍞','🥐','🥖','🥨','🥯','🥞','🧇','🧀','🍖','🍗','🥩','🥓','🍔','🍟',
      '🍕','🌭','🥪','🌮','🌯','🥙','🥚','🍳','🍲','🍝','🥗','🍣','🍤','🍥','🍦','🍧','🍨','🍩','🍪','🎂','🍰',
      '🧁','🍫','🍬','🍭','☕','🍵','🍶','🍷','🍸','🍹','🍺','🥂','🥃','🥤',
      '🐶','🐱','🐭','🐹','🐰','🦊','🐻','🐼','🐻‍❄️','🐨','🐯','🦁','🐮','🐷','🐸','🐵','🙈','🙉','🙊','🐔',
      '🐧','🐦','🐤','🐣','🦆','🦉','🦇','🐺','🐗','🐴','🦄','🐝','🐛','🦋','🐌','🐞','🐜','🕷️','🦂',
      '🐢','🐍','🦎','🦖','🦕','🐙','🦑','🦐','🦞','🦀','🐡','🐠','🐟','🐬','🐳','🦈','🐊','🦓','🦍',
      '🐘','🦛','🦏','🐪','🐫','🦒','🦘','🐃','🐄','🐑','🦙','🐐','🦌','🐕','🐩','🐈','🐓','🦜','🦢',
      '🦩','🕊️','🐇','🦝','🦨','🦡','🦦','🦥','🐀','🐿️','🦔',
      '⌚','📱','💻','🖥️','🖨️','🕹️','💿','📸','📹','🎥','📺','📻','💡','🔦','🧭','⏰','💰','💳','💎','📚','📖',
      '📕','📗','📘','📙','📒','📔','📓','📃','📜','📄','📑','🗞️','📰','✉️','📧','📮','📫','📦','📬','📪',
      '✏️','✒️','🖊️','🖋️','🖌️','🖍️','📝','📎','🖇️','📐','📏','📊','📈','📉','📅','📆','🗓️','📇','📋','🗃️','🗄️',
      '📁','📂','🗂️','🗑️','🔒','🔓','🔏','🔐','🔑','🗝️','⚙️','🧰','🔧','🔨','⚒️','🪓','🧱',
      '🧺','🧼','🧽','🧴','🪑','🛋️','🛏️','🛁','🚿','🚽','🚰','🧻','🧯','🧹','🧺',
      '💈','🔭','🔬','🕳️','💊','💉','🩸','🩺','🩹','🧬','🦠','🧫','🧪','🧠','💅','💄','💋','💍','💎',
      '👓','🕶️','🥽','🥼','👔','👕','👖','👗','👘','🥻','🩱','🩲','👙','👚','👛','👜','👝','🛍️','🎒','👞',
      '👟','🥾','👠','👡','👢','👑','👒','🎩','🎓','🧢',
      '❤️','🧡','💛','💚','💙','💜','🖤','🤍','🤎','💔','❣️','💕','💞','💓','💖','💘','💝','💟','☮️','☯️','⚛️',
      '♻️','✅','❌','⚠️','❗','❓','💯','♾️','™️','©️','®️','🔞','💲','💱','✔️','➕','➖','➗','✖️',
      '⬆️','⬇️','⬅️','➡️','🔁','🔂','🔄','🔃','♠️','♣️','♥️','♦️','🎵','🎶','🆕','🆒','🆗','🆓','🆙'
    ],

    Comida: 
    ['🍇','🍉','🍊','🍋','🍌','🍍','🥭','🍎','🍏','🍐','🍑','🍒','🍓','🥝','🍅','🥥','🥑','🍆','🥔','🥕','🌽',
      '🥦','🥬','🧄','🧅','🍄','🥜','🍞','🥐','🥖','🥨','🥯','🥞','🧇','🧀','🍖','🍗','🥩','🥓','🍔','🍟',
      '🍕','🌭','🥪','🌮','🌯','🥙','🥚','🍳','🍲','🍝','🥗','🍣','🍤','🍥','🍦','🍧','🍨','🍩','🍪','🎂','🍰',
      '🧁','🍫','🍬','🍭','☕','🍵','🍶','🍷','🍸','🍹','🍺','🥂','🥃','🥤'],

    Animales: 
    ['🐶','🐱','🐭','🐹','🐰','🦊','🐻','🐼','🐻‍❄️','🐨','🐯','🦁','🐮','🐷','🐸','🐵','🙈','🙉','🙊','🐔',
      '🐧','🐦','🐤','🐣','🦆','🦉','🦇','🐺','🐗','🐴','🦄','🐝','🐛','🦋','🐌','🐞','🐜','🕷️','🦂',
      '🐢','🐍','🦎','🦖','🦕','🐙','🦑','🦐','🦞','🦀','🐡','🐠','🐟','🐬','🐳','🦈','🐊','🦓','🦍',
      '🐘','🦛','🦏','🐪','🐫','🦒','🦘','🐃','🐄','🐑','🦙','🐐','🦌','🐕','🐩','🐈','🐓','🦜','🦢',
      '🦩','🕊️','🐇','🦝','🦨','🦡','🦦','🦥','🐀','🐿️','🦔'],
      
    Objetos: 
    ['⌚','📱','💻','🖥️','🖨️','🕹️','💿','📸','📹','🎥','📺','📻','💡','🔦','🧭','⏰','💰','💳','💎','📚','📖',
      '📕','📗','📘','📙','📒','📔','📓','📃','📜','📄','📑','🗞️','📰','✉️','📧','📮','📫','📦','📬','📪',
      '✏️','✒️','🖊️','🖋️','🖌️','🖍️','📝','📎','🖇️','📐','📏','📊','📈','📉','📅','📆','🗓️','📇','📋','🗃️','🗄️',
      '📁','📂','🗂️','🗑️','🔒','🔓','🔏','🔐','🔑','🗝️','⚙️','🧰','🔧','🔨','⚒️','🪓','🧱',
      '🧺','🧼','🧽','🧴','🪑','🛋️','🛏️','🛁','🚿','🚽','🚰','🧻','🧯','🧹','🧺',
      '💈','🔭','🔬','🕳️','💊','💉','🩸','🩺','🩹','🧬','🦠','🧫','🧪','🧠','💅','💄','💋','💍','💎',
      '👓','🕶️','🥽','🥼','👔','👕','👖','👗','👘','🥻','🩱','🩲','👙','👚','👛','👜','👝','🛍️','🎒','👞',
      '👟','🥾','👠','👡','👢','👑','👒','🎩','🎓','🧢'],
    
    Símbolos: 
    ['❤️','🧡','💛','💚','💙','💜','🖤','🤍','🤎','💔','❣️','💕','💞','💓','💖','💘','💝','💟','☮️','☯️','⚛️',
      '♻️','✅','❌','⚠️','❗','❓','💯','♾️','™️','©️','®️','🔞','💲','💱','✔️','➕','➖','➗','✖️',
      '⬆️','⬇️','⬅️','➡️','🔁','🔂','🔄','🔃','♠️','♣️','♥️','♦️','🎵','🎶','🆕','🆒','🆗','🆓','🆙']
  };

  function renderGrid(grid, list) {
    if (!grid) return;
    grid.innerHTML = '';
    list.forEach(em => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 's-emoji-option';
      btn.textContent = em;
      btn.addEventListener('click', () => {
        grid.querySelectorAll('.s-emoji-option.s-selected').forEach(x => x.classList.remove('s-selected'));
        btn.classList.add('s-selected');

        const modal = grid.closest('.s-modal');
        const hiddenEmoji = modal?.querySelector('#s-selected-emoji');
        const preview = modal?.querySelector('#s-selected-emoji-preview');

        if (hiddenEmoji) {
          hiddenEmoji.value = em;
          hiddenEmoji.dataset.autogen = '0'; // elegido manualmente
        }
        if (preview) preview.textContent = em;

        if (modal) modal.dataset.userSelectedEmoji = '1';
      });
      grid.appendChild(btn);
    });
  }

  // ---------- Normalización y mapeo ----------
  function stripDiacritics(s) {
    const val = String(s || '');
    try {
      return val.normalize('NFD').replace(/\p{Diacritic}/gu, '');
    } catch {
      return val.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    }
  }

  function normalizeName(str) {
    return stripDiacritics(str).toLowerCase();
  }

  function detectEmojiByName(name) {
    const n = normalizeName(name);
    if (!n) return '🔸';

    // ==== Comida y supermercado (alta prioridad) ====
    if (n.includes('manzana') || n.includes('apple')) return '🍎';
    if (n.includes('banana') || n.includes('platano') || n.includes('banano') || n.includes('plantain')) return '🍌';
    if (n.includes('pera') || n.includes('pear')) return '🍐';
    if (n.includes('melocoton') || n.includes('durazno') || n.includes('peach')) return '🍑';
    if (n.includes('fresa') || n.includes('strawberry')) return '🍓';
    if (n.includes('uva') || n.includes('grape')) return '🍇';
    if (n.includes('melon') || n.includes('honeydew') || n.includes('cantalupo') || n.includes('cantaloupe')) return '🍈';
    if (n.includes('sandia') || n.includes('watermelon')) return '🍉';
    if (n.includes('naranja') || n.includes('orange')) return '🍊';
    if (n.includes('limon') || n.includes('lima') || n.includes('lemon') || n.includes('lime')) return '🍋';
    if (n.includes('pina') || n.includes('anana') || n.includes('pineapple')) return '🍍';
    if (n.includes('mango')) return '🥭';
    if (n.includes('kiwi')) return '🥝';
    if (n.includes('arandano') || n.includes('blueberr')) return '🫐';
    if (n.includes('aceituna') || n.includes('oliva') || n.includes('olive')) return '🫒';
    if (n.includes('aguacate') || n.includes('palta') || n.includes('avocado')) return '🥑';
    if (n.includes('coco') || n.includes('coconut')) return '🥥';
    if (n.includes('tomate') || n.includes('tomato')) return '🍅';
    if (n.includes('berenjena') || n.includes('eggplant') || n.includes('aubergine')) return '🍆';
    if (n.includes('patata') || n.includes('papa') || n.includes('potato')) return '🥔';
    if (n.includes('zanahoria') || n.includes('carrot')) return '🥕';
    if (n.includes('maiz') || n.includes('elote') || n.includes('corn')) return '🌽';
    if (n.includes('pepino') || n.includes('cucumber')) return '🥒';
    if (n.includes('brocoli') || n.includes('broccoli')) return '🥦';
    if (n.includes('lechuga') || n.includes('acelga') || n.includes('espinaca') || n.includes('greens') || n.includes('lettuce')) return '🥬';
    if (n.includes('ajo') || n.includes('garlic')) return '🧄';
    if (n.includes('cebolla') || n.includes('onion')) return '🧅';
    if (n.includes('champi') || n.includes('seta') || n.includes('hongo') || n.includes('mushroom')) return '🍄';
    if (n.includes('cacahu') || n.includes('mani') || n.includes('peanut')) return '🥜';
    if (n.includes('castana') || n.includes('chestnut')) return '🌰';

    // Panadería y lácteos
    if (n.includes('pan ') || n === 'pan' || n.includes('bread')) return '🍞';
    if (n.includes('croissant')) return '🥐';
    if (n.includes('baguette')) return '🥖';
    if (n.includes('bagel')) return '🥯';
    if (n.includes('gofre') || n.includes('waffle')) return '🧇';
    if (n.includes('tortita') || n.includes('hotcake') || n.includes('pancake')) return '🥞';
    if (n.includes('queso') || n.includes('cheese')) return '🧀';
    if (n.includes('mantequilla') || n.includes('butter')) return '🧈';
    if (n.includes('leche') || n.includes('milk')) return '🥛';
    if (n.includes('yogur') || n.includes('yogurt')) return '🥛';

    // Proteínas y platos
    if (n.includes('carne') || n.includes('beef') || n.includes('res') || n.includes('steak')) return '🥩';
    if (n.includes('pollo') || n.includes('chicken')) return '🍗';
    if (n.includes('pavo') || n.includes('turkey')) return '🦃';
    if (n.includes('cerdo') || n.includes('pork') || n.includes('bacon') || n.includes('tocino')) return '🥓';
    if (n.includes('pesc') || n.includes('fish')) return '🐟';
    if (n.includes('camaron') || n.includes('gamba') || n.includes('shrimp') || n.includes('prawn')) return '🍤';
    if (n.includes('huevo') || n.includes('egg')) return '🥚';
    if (n.includes('quesadilla') || n.includes('taco')) return '🌮';
    if (n.includes('burrito')) return '🌯';
    if (n.includes('tamal') || n.includes('tamale')) return '🫔';
    if (n.includes('wrap') || n.includes('kebab') || n.includes('gyro')) return '🥙';
    if (n.includes('falafel')) return '🧆';
    if (n.includes('hamburg') || n.includes('burger')) return '🍔';
    if (n.includes('patata frita') || n.includes('papas') || n.includes('fries') || n.includes('chips')) return '🍟';
    if (n.includes('perrito') || n.includes('hot dog') || n.includes('salchicha')) return '🌭';
    if (n.includes('pizza')) return '🍕';
    if (n.includes('pasta') || n.includes('espagueti') || n.includes('spaghett') || n.includes('fideo') || n.includes('noodle')) return '🍝';
    if (n.includes('ramen')) return '🍜';
    if (n.includes('arroz') || n.includes('rice')) return '🍚';
    if (n.includes('curry')) return '🍛';
    if (n.includes('sopa') || n.includes('caldo') || n.includes('stew') || n.includes('soup')) return '🍲';
    if (n.includes('paella') || n.includes('cazuela') || n.includes('shallow')) return '🥘';
    if (n.includes('fondue')) return '🫕';
    if (n.includes('ensalada') || n.includes('salad')) return '🥗';
    if (n.includes('cereal') || n.includes('tazon') || n.includes('tazón') || n.includes('bowl')) return '🥣';
    if (n.includes('palomita') || n.includes('popcorn')) return '🍿';
    if (n.includes('lata') || n.includes('enlat') || n.includes('canned')) return '🥫';

    // Dulces y postres
    if (n.includes('helado') && n.includes('cono')) return '🍦';
    if (n.includes('granizado') || n.includes('raspado') || n.includes('shaved ice')) return '🍧';
    if (n.includes('sundae') || (n.includes('helado') && !n.includes('cono'))) return '🍨';
    if (n.includes('dona') || n.includes('donut') || n.includes('doughnut')) return '🍩';
    if (n.includes('galleta') || n.includes('cookie')) return '🍪';
    if (n.includes('pastel') || n.includes('torta') || n.includes('cake')) return '🎂';
    if (n.includes('tarta') || n.includes('slice')) return '🍰';
    if (n.includes('cupcake') || n.includes('magdalena')) return '🧁';
    if (n.includes('pie') || n.includes('pay')) return '🥧';
    if (n.includes('chocolate')) return '🍫';
    if (n.includes('caramelo') || n.includes('candy')) return '🍬';
    if (n.includes('piruleta') || n.includes('lollipop')) return '🍭';
    if (n.includes('flan') || n.includes('pudin') || n.includes('pudding') || n.includes('custard')) return '🍮';
    if (n.includes('miel') || n.includes('honey')) return '🍯';
    if (n.includes('mooncake') || n.includes('luna')) return '🥮';
    if (n.includes('dango')) return '🍡';
    if (n.includes('dumpling') || n.includes('empanad')) return '🥟';
    if (n.includes('fortune cookie') || n.includes('fortuna')) return '🥠';
    if (n.includes('takeout') || n.includes('para llevar') || n.includes('para-llevar')) return '🥡';

    // Bebidas
    if (n.includes('cafe') || n.includes('cafe ') || n.includes('café') || n.includes('coffee')) return '☕';
    if (n.includes('te') || n.includes('té') || n.includes('tea')) return '🍵';
    if (n.includes('sake')) return '🍶';
    if (n.includes('vino') || n.includes('wine')) return '🍷';
    if (n.includes('martini') || n.includes('coctel') || n.includes('cóctel') || n.includes('cocktail')) return '🍸';
    if (n.includes('trago') || n.includes('tropical drink')) return '🍹';
    if (n.includes('cerveza') || n.includes('beer')) return '🍺';
    if (n.includes('brindis') || n.includes('champagne') || n.includes('cava') || n.includes('brindar')) return '🥂';
    if (n.includes('whisky') || n.includes('whiskey') || n.includes('tumbler')) return '🥃';
    if (n.includes('refresco') || n.includes('soda') || n.includes('bebida') || n.includes('drink')) return '🥤';
    if (n.includes('boba') || n.includes('bubble tea')) return '🧋';
    if (n.includes('jugo') || n.includes('zumo') || n.includes('juice')) return '🧃';
    if (n.includes('mate')) return '🧉';
    if (n.includes('hielo') || n.includes('ice')) return '🧊';

    // Limpieza, hogar y baño
    if (n.includes('higien') || n.includes('hig') || n.includes('toilet') || n.includes('sanitario') || n.includes('papel')) return '🧻';
    if (n.includes('jabon') || n.includes('jab') || n.includes('soap')) return '🧼';
    if (n.includes('esponj') || n.includes('sponge')) return '🧽';
    if (n.includes('limpia') || n.includes('fregar') || n.includes('barrer') || n.includes('escoba')) return '🧹';
    if (n.includes('detergente') || n.includes('shampoo') || n.includes('gel') || n.includes('locion') || n.includes('lotion')) return '🧴';
    if (n.includes('extintor') || n.includes('extinguisher')) return '🧯';
    if (n.includes('ducha') || n.includes('shower')) return '🚿';
    if (n.includes('banera') || n.includes('bano') || n.includes('baño') || n.includes('bathtub')) return '🛁';
    if (n.includes('lavabo') || n.includes('grifo') || n.includes('water')) return '🚰';
    if (n.includes('inodoro') || n.includes('wc') || n.includes('toilet')) return '🚽';

    // Papelería y oficina
    if (n.includes('lapiz') || n.includes('lápiz') || n.includes('pencil')) return '✏️';
    if (n.includes('pluma') || n.includes('fountain pen')) return '✒️';
    if (n.includes('boligrafo') || n.includes('birome') || n.includes('pen ')) return '🖊️';
    if (n.includes('pincel') || n.includes('brocha') || n.includes('paintbrush')) return '🖌️';
    if (n.includes('crayon')) return '🖍️';
    if (n.includes('libro') || n.includes('book')) return '📚';
    if (n.includes('cuaderno') || n.includes('notebook')) return '📓';
    if (n.includes('carpeta') || n.includes('folder')) return '📁';
    if (n.includes('clip')) return '📎';
    if (n.includes('regla') || n.includes('ruler')) return '📏';
    if (n.includes('escuadra') || n.includes('set square')) return '📐';
    if (n.includes('nota') || n.includes('memo') || n.includes('post-it')) return '📝';
    if (n.includes('calendario') || n.includes('calendar')) return '📅';

    // Herramientas
    if (n.includes('llave') || n.includes('wrench') || n.includes('spanner')) return '🔧';
    if (n.includes('martillo') || n.includes('hammer')) return '🔨';
    if (n.includes('hacha') || n.includes('axe')) return '🪓';
    if (n.includes('engranaje') || n.includes('gear')) return '⚙️';
    if (n.includes('destornill') || n.includes('screwdriver')) return '🪛';
    if (n.includes('taladro') || n.includes('drill')) return '🛠️';

    // Electrónica
    if (n.includes('bombilla') || n.includes('foco') || n.includes('light')) return '💡';
    if (n.includes('linterna') || n.includes('flashlight')) return '🔦';
    if (n.includes('movil') || n.includes('celular') || n.includes('telefono') || n.includes('phone')) return '📱';
    if (n.includes('portatil') || n.includes('laptop') || n.includes('computadora') || n.includes('ordenador') || n.includes('pc')) return '💻';
    if (n.includes('tele') || n.includes('tv') || n.includes('television')) return '📺';
    if (n.includes('radio')) return '📻';
    if (n.includes('camara') || n.includes('cámara') || n.includes('camera')) return '📸';
    if (n.includes('impresora') || n.includes('printer')) return '🖨️';

    // Ropa y calzado
    if (n.includes('camiseta') || n.includes('playera') || n.includes('shirt')) return '👕';
    if (n.includes('pantal') || n.includes('jean') || n.includes('vaquero') || n.includes('trouser')) return '👖';
    if (n.includes('vestido') || n.includes('dress')) return '👗';
    if (n.includes('falda') || n.includes('skirt')) return '👗';
    if (n.includes('sudadera') || n.includes('hoodie') || n.includes('sueter') || n.includes('suéter') || n.includes('sweater')) return '🧥';
    if (n.includes('zapato') || n.includes('calzado') || n.includes('shoe')) return '👞';
    if (n.includes('zapat') || n.includes('tenis') || n.includes('sneaker') || n.includes('deportiva')) return '👟';
    if (n.includes('bota') || n.includes('boot')) return '🥾';
    if (n.includes('sandalia') || n.includes('sandal')) return '👡';
    if (n.includes('tacon') || n.includes('tacones') || n.includes('heel')) return '👠';
    if (n.includes('mochila') || n.includes('backpack')) return '🎒';
    if (n.includes('gorra') || n.includes('cap')) return '🧢';
    if (n.includes('gafas') || n.includes('lentes') || n.includes('glasses')) return '👓';

    // Animales
    if (n.includes('perro') || n.includes('dog')) return '🐶';
    if (n.includes('gato') || n.includes('cat')) return '🐱';
    if (n.includes('pez') || n.includes('fish')) return '🐟';
    if (n.includes('pajaro') || n.includes('ave') || n.includes('bird')) return '🐦';

    // Ocio y deportes
    if (n.includes('balon') || n.includes('balón') || n.includes('futbol') || n.includes('soccer')) return '⚽';
    if (n.includes('basket') || n.includes('baloncesto') || n.includes('basketball')) return '🏀';
    if (n.includes('tenis')) return '🎾';

    // Transporte y lugares
    if (n.includes('coche') || n.includes('auto') || n.includes('car')) return '🚗';
    if (n.includes('moto') || n.includes('motorcycle')) return '🏍️';
    if (n.includes('avion') || n.includes('airplane') || n.includes('vuelo') || n.includes('flight')) return '✈️';
    if (n.includes('barco') || n.includes('ship') || n.includes('crucero')) return '🛳️';
    if (n.includes('casa') || n.includes('hogar') || n.includes('house') || n.includes('home')) return '🏠';

    // Salud
    if (n.includes('pastilla') || n.includes('medicina') || n.includes('medicamento') || n.includes('pill')) return '💊';
    if (n.includes('curita') || n.includes('tira') || n.includes('bandage')) return '🩹';

    // Símbolos
    if (n.includes('check') || n.includes('ok') || n.includes('hecho') || n.includes('listo') || n.includes('done')) return '✅';
    if (n.includes('alerta') || n.includes('cuidado') || n.includes('warning')) return '⚠️';
    if (n.includes('corazon') || n.includes('amor') || n.includes('love') || n.includes('heart')) return '❤️';

    return '🔸';
  } 
   // ---------- Auto-emoji con control de autogen ----------
  function maybeAutoSetEmoji(ctx) {
    const scope = ctx || document;
    const nameInput = scope.querySelector('#s-product-name');
    const hiddenEmoji = scope.querySelector('#s-selected-emoji');
    const preview = scope.querySelector('#s-selected-emoji-preview');
    const emojiGrid = scope.querySelector('#s-emoji-grid');
    const modal = scope.closest?.('.s-modal') || scope.querySelector?.('.s-modal') || scope;

    if (!nameInput || !hiddenEmoji || !preview) return;

    const candidate = detectEmojiByName(nameInput.value);

    const userSelected = modal && modal.dataset.userSelectedEmoji === '1';
    const isAutogen = hiddenEmoji.dataset.autogen === '1';
    const isEmptyOrFallback = !hiddenEmoji.value || hiddenEmoji.value === '🔸';

    const canReplace = !userSelected && (isAutogen || isEmptyOrFallback);

    if (canReplace) {
      hiddenEmoji.value = candidate;
      hiddenEmoji.dataset.autogen = '1';
      preview.textContent = candidate;

      if (emojiGrid) {
        const match = Array.from(emojiGrid.querySelectorAll('.s-emoji-option'))
          .find(btn => btn.textContent === candidate);
        emojiGrid.querySelectorAll('.s-emoji-option.s-selected').forEach(x => x.classList.remove('s-selected'));
        if (match) match.classList.add('s-selected');
      }
    }
  }

  function bindEmojiUIOnce(ctx) {
    const scope = ctx || document;
    if (scope.__emojiBound) return;
    scope.__emojiBound = true;

    const grid = scope.querySelector('#s-emoji-grid');
    const nameInput = scope.querySelector('#s-product-name');
    const hiddenEmoji = scope.querySelector('#s-selected-emoji');

    if (grid) renderGrid(grid, emojiCategories['all']);

    // Tabs de categorías
    const tabs = root?.querySelectorAll('.s-category-btn') || [];
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        root.querySelectorAll('.s-category-btn').forEach(t => t.classList.remove('s-active'));
        tab.classList.add('s-active');
        const category = tab.dataset.category || 'all';
        renderGrid(grid, emojiCategories[category] || emojiCategories['all']);
        maybeAutoSetEmoji(scope);
      });
    });

    if (nameInput) {
      ['input','change','blur'].forEach(ev => {
        nameInput.addEventListener(ev, () => {
          // Si el emoji fue autogenerado o está vacío/fallback, reemplazar
          maybeAutoSetEmoji(scope);
        });
      });
    }

    if (hiddenEmoji) {
      hiddenEmoji.addEventListener('change', () => {
        const modal = scope.closest?.('.s-modal') || scope;
        if (modal && (!hiddenEmoji.value || hiddenEmoji.value === '')) {
          delete modal.dataset.userSelectedEmoji;
          hiddenEmoji.dataset.autogen = '1'; // permitir autogen de nuevo
          maybeAutoSetEmoji(scope);
        }
      });
    }
  }

  // Bind inicial (por si el modal está ya en DOM)
  bindEmojiUIOnce(document);

})();
</script>

      </div>

    </div>
  </div>
</x-layouts.app>
