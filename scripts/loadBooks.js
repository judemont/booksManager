async function getBooks() {
    const response = await fetch("php/books.php");
    const books = await response.json();
    return books;
}

function displayBooks(books, booksEmp) {
    let booksHtml = "";

    books.forEach(book => {
        booksHtml += getBookHtml(book.title, book.ID, book.coverUrl);
    });

    booksEmp.innerHTML = booksHtml;
}   

function getBookHtml(title, id, coverUrl){
    return `
        <div id='book_${id}'>
            <h2>${title}</h2>
            <img src="${coverUrl}" alt="${title} Cover">
        </div>
    `;
}

const booksEmp = document.getElementById("booksEmp");
getBooks().then(books => displayBooks(books, booksEmp));
