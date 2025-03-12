const cells = document.querySelectorAll(".cell");
const statusText = document.getElementById("status");
const resetButton = document.getElementById("reset");

let board = ["", "", "", "", "", "", "", "", ""];
let currentPlayer = "X"; 
let running = true;

const winningConditions = [
    [0, 1, 2], [3, 4, 5], [6, 7, 8],  // Linhas
    [0, 3, 6], [1, 4, 7], [2, 5, 8],  // Colunas
    [0, 4, 8], [2, 4, 6]              // Diagonais
];

cells.forEach(cell => cell.addEventListener("click", handleCellClick));
resetButton.addEventListener("click", resetGame);

function handleCellClick() {
    const index = this.getAttribute("data-index");

    if (board[index] !== "" || !running || currentPlayer === "O") {
        return;
    }

    board[index] = currentPlayer;
    this.textContent = currentPlayer;

    checkWinner();

    if (running) {
        setTimeout(computerMove, 500); 
    }
}

function computerMove() {
    let emptyCells = board.map((value, index) => value === "" ? index : null).filter(value => value !== null);

    if (emptyCells.length === 0 || !running) {
        return;
    }

    let randomIndex = emptyCells[Math.floor(Math.random() * emptyCells.length)];
    board[randomIndex] = "O";
    cells[randomIndex].textContent = "O";

    checkWinner();
}

function checkWinner() {
    for (let condition of winningConditions) {
        const [a, b, c] = condition;
        if (board[a] && board[a] === board[b] && board[a] === board[c]) {
            statusText.textContent = `Jogador ${currentPlayer} venceu!`;
            running = false;
            return;
        }
    }

    if (!board.includes("")) {
        statusText.textContent = "Empate!";
        running = false;
        return;
    }

    currentPlayer = currentPlayer === "X" ? "O" : "X";
    statusText.textContent = `Vez do jogador ${currentPlayer}`;
}

function resetGame() {
    board = ["", "", "", "", "", "", "", "", ""];
    currentPlayer = "X";
    running = true;
    statusText.textContent = "Jogo iniciado!";

    cells.forEach(cell => (cell.textContent = ""));
}
