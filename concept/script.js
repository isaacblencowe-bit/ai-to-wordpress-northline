'use strict';
const menu = document.querySelector('.menu-button');
const navigation = document.querySelector('#navigation');
function closeMenu(returnFocus = false) {
  navigation.classList.remove('open');
  menu.setAttribute('aria-expanded', 'false');
  if (returnFocus) menu.focus();
}
menu.addEventListener('click', () => {
  const open = navigation.classList.toggle('open');
  menu.setAttribute('aria-expanded', String(open));
});
navigation.querySelectorAll('a').forEach(link => link.addEventListener('click', () => closeMenu()));
document.addEventListener('keydown', event => {
  if (event.key === 'Escape' && navigation.classList.contains('open')) closeMenu(true);
});
window.matchMedia('(min-width: 761px)').addEventListener('change', event => {
  if (event.matches) closeMenu();
});
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
const openButton = document.querySelector('#enquiry-open');
const closeButton = document.querySelector('#enquiry-close');
const panel = document.querySelector('#enquiry-panel');
openButton.addEventListener('click', () => {
  panel.hidden = false;
  openButton.setAttribute('aria-expanded', 'true');
  closeButton.focus({preventScroll: true});
  panel.scrollIntoView({behavior: reducedMotion.matches ? 'instant' : 'smooth', block: 'center'});
});
closeButton.addEventListener('click', () => {
  panel.hidden = true;
  openButton.setAttribute('aria-expanded', 'false');
  openButton.focus({preventScroll: true});
});
let observer;
function configureReveals() {
  if (observer) observer.disconnect();
  document.querySelectorAll('.reveal-enter, .photo-enter').forEach(element => element.classList.remove('reveal-enter', 'photo-enter'));
  if (reducedMotion.matches || !('IntersectionObserver' in window)) return;
  observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add(entry.target.classList.contains('photo-reveal') ? 'photo-enter' : 'reveal-enter');
      entry.target.dataset.revealed = 'true';
      observer.unobserve(entry.target);
    });
  }, {threshold: 0.08});
  document.querySelectorAll('.reveal:not([data-revealed]), .photo-reveal:not([data-revealed])').forEach(element => observer.observe(element));
}
configureReveals();
reducedMotion.addEventListener('change', configureReveals);
