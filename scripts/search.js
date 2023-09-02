const searchInput = document.getElementById("searchInput");

async function getSearchJson(query){
    let searchApi = "https://openlibrary.org/search.json?q=" + encodeURIComponent(query) + "&limit=5";
    const response = await fetch(searchApi);
    const result = await response.json();
    return result;
}


function displayResults(results, resultEmp){
    let resultHtml = "";
    let coverUrl
    results.slice(0, 5).forEach(result => {
        coverUrl = "https://covers.openlibrary.org/b/id/" + result.cover_i + "-M.jpg"
        resultHtml += getResultHtml(result.title, coverUrl, result.key);
    });

    resultEmp.innerHTML = resultHtml;
}

function getResultHtml(title, coverUrl, code){
        return `
        <div>
            <a href='php/newBook.php?urlKey=${code}'>
            <h2>${title}</h2>
            </a>
            <img src="${coverUrl}" alt="${title} Cover">
        </div>
    `;
}


searchInput.addEventListener("input", function (e) {

    const resultsEmp = document.getElementById("resultsEmp")
    const content = this.value;

    if(content.length > 3){
        getSearchJson(content).then(result => displayResults(result.docs, resultsEmp));
    }

});