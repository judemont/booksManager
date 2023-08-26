async function getBooks() {
    const response = await fetch("php/books.php");
    const books = await response.json();
    return books;
}

function displayBooks(books, booksEmp) {
    let booksHtml = "";
    books.forEach(book => {
        booksHtml += getBookHtml(book.title, book.code, book.ID);
    });

    booksEmp.innerHTML = booksHtml;
}   

function getBookHtml(title, code, id){
    return `
        <div id='book_${id}'>
            <h2>${title}</h2>
            <h3>${code}</h3>
        </div>
    `;
}

const booksEmp = document.getElementById("booksEmp");
getBooks().then(books => displayBooks(books, booksEmp));
