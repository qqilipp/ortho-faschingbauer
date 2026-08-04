(function () {
  const btn = document.querySelector('.mnav-toggle');
  const panel = document.getElementById('mnav-panel');
  const backdrop = document.querySelector('.mnav-backdrop');

  if (!btn || !panel || !backdrop) return;

  function openNav(){
    document.body.classList.add('mnav-open');
    backdrop.hidden = false;
    panel.setAttribute('aria-hidden','false');
    btn.setAttribute('aria-expanded','true');
  }
  function closeNav(){
    document.body.classList.remove('mnav-open');
    backdrop.hidden = true;
    panel.setAttribute('aria-hidden','true');
    btn.setAttribute('aria-expanded','false');
  }

  btn.addEventListener('click', function(){
    if (document.body.classList.contains('mnav-open')) closeNav();
    else openNav();
  });

  backdrop.addEventListener('click', closeNav);
  document.addEventListener('keydown', function(e){
    if (e.key === 'Escape') closeNav();
  });

  // Submenus toggle
  panel.querySelectorAll('.menu-item-has-children > a').forEach(function(a){
    a.addEventListener('click', function(e){
      e.preventDefault();
      a.parentElement.classList.toggle('is-open');
    });
  });

  // initial
  backdrop.hidden = true;
})();