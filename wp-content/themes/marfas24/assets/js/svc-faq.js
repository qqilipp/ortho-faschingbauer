(function () {
  function initFaq(root) {
    if (!root || root.__svcFaqInit) return;
    root.__svcFaqInit = true;

    // initial state
    root.querySelectorAll('.svc-faq__panel').forEach(p => {
      p.hidden = true;
      p.style.maxHeight = '';
    });

    root.addEventListener('click', function (e) {
      const btn = e.target.closest('.svc-faq__btn');
      if (!btn || !root.contains(btn)) return;

      const panelId = btn.getAttribute('aria-controls');
      const panel = panelId ? document.getElementById(panelId) : null;
      if (!panel) return;

      const isOpen = btn.getAttribute('aria-expanded') === 'true';

      // accordion: close all
      root.querySelectorAll('.svc-faq__btn').forEach(b => {
        b.setAttribute('aria-expanded', 'false');
      });
      root.querySelectorAll('.svc-faq__panel').forEach(p => {
        p.hidden = true;
        p.style.maxHeight = '';
      });

      if (!isOpen) {
        btn.setAttribute('aria-expanded', 'true');
        panel.hidden = false;
        panel.style.maxHeight = panel.scrollHeight + 'px';
      }
    });
  }

  function boot() {
    document.querySelectorAll('[data-svc-faq]').forEach(initFaq);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();