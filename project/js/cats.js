const cats = [
  {
      name: "Mitten",
      type: "Cat",
      breed: "Balinese",
      age: 3,
      image: "images/mittens.jpg",
      description: "Playful and loving cat."
  },
  {
      name: "Celesta",
      type: "Cat",
      breed: "British Shorthair",
      age: 2,
      image: "images/cat2.jpg",
      description: "Calm and affectionate cat."
  },
  {
    name: "Snow",
    type: "Cat",
    breed: "Persian",
    age: 2,
    image: "images/cat3.jpg",
    description: "Calm and affectionate cat."
  },
  {
  name: "Coffee",
  type: "Cat",
  breed: "Maine Coon",
  age: 2,
  image: "images/cat4.jpg",
  description: "Calm and affectionate cat."
  },
  {
    name: "Lana",
    type: "Cat",
    breed: "Toygar",
    age: 2,
    image: "images/cat5.jpg",
    description: "Calm and affectionate cat."
  }
];

const catsList = document.getElementById("catsList");

cats.forEach(cat => {
  const catCard = document.createElement("div");
  catCard.classList.add("cats-card");
  catCard.innerHTML = `
      <img src="${cat.image}" alt="${cat.name}">
      <h3>${cat.name}</h3>
      <p><strong>Type:</strong> ${cat.type}</p>
      <p><strong>Breed:</strong> ${cat.breed}</p>
      <p><strong>Age:</strong> ${cat.age} months</p>
      <p>${cat.description}</p>
      <button class="adopt-btn" data-name="${cat.name}">Adopt</button>
  `;
  catsList.appendChild(catCard);
});

// Redirect to adoption form when clicking "Adopt"
document.addEventListener("click", function (event) {
  if (event.target.classList.contains("adopt-btn")) {
      const petName = event.target.getAttribute("data-name");
      window.location.href = `adform.html?cat=${encodeURIComponent(petName)}`;
  }
}); 