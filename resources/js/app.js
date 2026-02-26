import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function initPageTransitions() {
  document.body.classList.add('page-enter');
  requestAnimationFrame(() => {
    document.body.classList.add('page-enter-active');
  });
  document.addEventListener('click', (e) => {
    const link = e.target.closest('a');
    if (!link) return;
    const href = link.getAttribute('href');
    const target = link.getAttribute('target');
    const download = link.hasAttribute('download');
    if (!href || download || target === '_blank') return;
    if (href.startsWith('#')) return;
    const origin = link.origin || window.location.origin;
    const isSameOrigin = origin === window.location.origin;
    if (!isSameOrigin) return;
    e.preventDefault();
    document.body.classList.add('page-leave');
    requestAnimationFrame(() => {
      document.body.classList.add('page-leave-active');
    });
    setTimeout(() => {
      window.location.assign(href);
    }, 250);
  });
}

function initScrollReveal() {
  const observer = new IntersectionObserver((entries) => {
    for (const entry of entries) {
      if (entry.isIntersecting) {
        entry.target.classList.add('reveal-show');
        observer.unobserve(entry.target);
      }
    }
  }, { threshold: 0.1, rootMargin: '0px 0px -10% 0px' });
  document.querySelectorAll('[data-animate]').forEach((el) => {
    el.classList.add('reveal');
    observer.observe(el);
  });
}

function initParallax() {
  const layers = Array.from(document.querySelectorAll('[data-parallax]'));
  if (!layers.length) return;
  const onScroll = () => {
    const y = window.scrollY || window.pageYOffset;
    for (const el of layers) {
      const speed = parseFloat(el.dataset.parallax) || 0.15;
      el.style.transform = `translate3d(0, ${y * speed}px, 0)`;
    }
  };
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });
}

window.addEventListener('DOMContentLoaded', () => {
  initPageTransitions();
  initScrollReveal();
  initParallax();
});
