const colorOfCards = ["red", "red", "green", "green", "blue", "blue", "brown", "brown",
                      "gray", "gray", "yellow", "yellow", "cadetblue", "cadetblue", "violet",
                       "violet", "lightgreen", "lightgreen"];

let cards = document.querySelectorAll(".card-hidden");
console.log(cards);

// Zamiana listy na tablice
cards = [...cards]; // 18 kart

const startTime = new Date().getTime();

// Do przechowywania kart kliknietych
let activeCard = "";
const activeCards = [];

const totalGamePairs = cards.length / 2;
let gameResult = 0;

if(totalGamePairs == gameResult) {

}

const clickCard = function() {
    activeCard = this; // przechowuje diva
    if(activeCard == activeCards[0]) {
        return;
    }

    activeCard.classList.remove("hidden");

    if(activeCards.length === 0) {
        // pierwsze klikniecie
        activeCards[0] = activeCard;
    }
    else {
        // drugie kliknięcie
        cards.forEach(card => {
            card.removeEventListener("click", clickCard);
        });

        activeCards[1] = activeCard;

        setTimeout(function() {
            if(activeCards[0].className === activeCards[1].className){
                // Dodanie nowej klasy gdy wybrano taki sam typ
                activeCards.forEach(card => card.classList.add("off"));
                gameResult++;

                // Usuniecie kart odgadnietych
                cards = cards.filter(card => !(card.classList.contains("off")));

                // Jesli wszystkie karty wylosowane wyswietl wynik i zresetuj
                if(gameResult === totalGamePairs) {
                    const endTime = new Date().getTime();
                    const endGame = (endTime - startTime) / 1000;
                    alert(`Udało się! Twój wynik to: ${endGame} sekund`)
                    location.reload();
                }
            }
            else {
                activeCards.forEach(card => card.classList.add("hidden"));
            }
            activeCard = "";
            activeCards.length = 0;

            cards.forEach(card => card.addEventListener("click", clickCard));

        }, 500);

    }
    console.log(activeCards);
    console.log(cards);
};

const init = function() {

    // Wylosuj kolory kart
    cards.forEach(card => {
        const position = Math.floor(Math.random() * colorOfCards.length);
        //console.log(position);
        card.classList.add(colorOfCards[position]);
        colorOfCards.splice(position, 1);
    });
    // Po x sekund ukryj karty
    setTimeout(function() {
        cards.forEach(card => {
            card.classList.add("hidden");
            card.addEventListener("click", clickCard);
        });
    }, 2000);

}

const startGame = function() {
    let startMenu = document.getElementById("menu");
    let game = document.getElementsByTagName('main')[0];
    startMenu.style = "display:none;";
    game.classList.add("game");

    cards.forEach(card => {
        card.classList.remove("card-hidden");
    });
    //console.log(cards);
    game = document.getElementsByTagName('main')[0];
    startMenu.style = "display:none;";
    game.classList.add("game");

    cards.forEach(card => {
        card.classList.remove("card-hidden");
    });
    //console.log(cards);
    init();
}
//
