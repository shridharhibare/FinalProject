const dogs = [
  {
    name: "Sheru",
    type: "Dog",
    breed: "Golden Retriever",
    age: 7,
    image: "images/buddy.jpg",
    description: "Playful and loving dog."
  },
  {
    name: "Max",
    type: "Dog",
    breed: "Beagle",
    age: 2,
    image: "images/dog2.jpg",
    description: "Calm and affectionate dogs."
  },
  {
    name: "Simba",
    type: "Dog",
    breed: "German Shepard",
    age: 3,
    image: "images/dog3.jpg",
    description: "Playful and loving dog."
  },
  {
    name: "Monty",
    type: "Dog",
    breed: "Labrador",
    age: 3,
    image: "images/dog4.jpg",
    description: "Playful and loving dog."
  },
  {
    name: "Finn",
    type: "Dog",
    breed: "Beagle",
    age: 2,
    image: "images/dog5.jpg",
    description: "Playful and loving dog."
  }
];

const dogsList = document.getElementById("dogsList");

dogs.forEach(dog => {
  const dogCard = document.createElement("div");
  dogCard.classList.add("dog-card");
  dogCard.innerHTML = `
      <img src="${dog.image}" alt="${dog.name}">
      <h3>${dog.name}</h3>
      <p><strong>Type:</strong> ${dog.type}</p>
      <p><strong>Breed:</strong> ${dog.breed}</p>
      <p><strong>Age:</strong> ${dog.age} months</p>
      <p>${dog.description}</p>
      <button class="adopt-btn" data-name="${dog.name}">Adopt</button>
  `;
  dogsList.appendChild(dogCard);
});

// Redirect to adoption form when clicking "Adopt"
document.addEventListener("click", function (event) {
  if (event.target.classList.contains("adopt-btn")) {
      const petName = event.target.getAttribute("data-name");
      window.location.href = `adform.html?dog=${encodeURIComponent(petName)}`;
  }
});

