(() => {
 'use strict';
 const menu = document.querySelector('.nl-menu-button');
 const nav = document.querySelector('#northline-navigation');
 if (menu && nav) {
  const close = (focus = false) => { nav.classList.remove('open'); menu.setAttribute('aria-expanded','false'); if (focus) menu.focus(); };
  menu.addEventListener('click', () => menu.setAttribute('aria-expanded', String(nav.classList.toggle('open'))));
  nav.querySelectorAll('a').forEach(link => link.addEventListener('click', () => close()));
  document.addEventListener('keydown', event => { if (event.key === 'Escape' && nav.classList.contains('open')) close(true); });
  matchMedia('(min-width:761px)').addEventListener('change', event => { if (event.matches) close(); });
 }
 const reduced = matchMedia('(prefers-reduced-motion:reduce)');
 const editing = document.body.classList.contains('elementor-editor-active') || new URLSearchParams(location.search).has('elementor-preview');
 const open = document.querySelector('#enquiry-open button');
 const close = document.querySelector('#enquiry-close button');
 const panel = document.querySelector('#enquiry-panel');
 if (panel && open && close && !editing) {
  panel.hidden = true;
  open.addEventListener('click', event => { event.preventDefault(); panel.hidden = false; open.setAttribute('aria-expanded','true'); close.focus({preventScroll:true}); panel.scrollIntoView({behavior:reduced.matches?'instant':'smooth',block:'center'}); });
  close.addEventListener('click', event => { event.preventDefault(); panel.hidden=true; open.setAttribute('aria-expanded','false'); open.focus({preventScroll:true}); });
 }
 let observer;
 const reveals = () => {
  if (observer) observer.disconnect();
  document.querySelectorAll('.nl-reveal-enter,.nl-photo-enter').forEach(el => el.classList.remove('nl-reveal-enter','nl-photo-enter'));
  if (editing || reduced.matches || !('IntersectionObserver' in window)) return;
  observer = new IntersectionObserver(entries => entries.forEach(entry => {
   if (!entry.isIntersecting) return;
   entry.target.classList.add(entry.target.classList.contains('nl-photo-reveal')?'nl-photo-enter':'nl-reveal-enter');
   entry.target.dataset.nlRevealed='true'; observer.unobserve(entry.target);
  }),{threshold:.08});
  document.querySelectorAll('.nl-reveal:not([data-nl-revealed]),.nl-photo-reveal:not([data-nl-revealed])').forEach(el => observer.observe(el));
 };
 reveals(); reduced.addEventListener('change',reveals);
})();
