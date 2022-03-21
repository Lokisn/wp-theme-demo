document.addEventListener("DOMContentLoaded", () => {
  // Valider si on est sur l'accueil
  const home = document.querySelector(".home");
  if (home) {
    new Splide(".splide").mount();
  }

  const galerie = document.querySelector(".galerie");
  if (galerie) {
    new SimpleLightbox({ elements: ".galerie a" });
  }
});
