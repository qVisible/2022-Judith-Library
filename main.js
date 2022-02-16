function Get(isbn){
    var yourUrl="https://www.googleapis.com/books/v1/volumes?q=isbn:"+isbn;
    var Httpreq = new XMLHttpRequest(); // a new request
    Httpreq.open("GET",yourUrl,false);
    Httpreq.send(null);
    return Httpreq.responseText;          
}

function getBookDetails(isbn){
    var json_obj = JSON.parse(Get(isbn));
    console.log("this is the author name: "+json_obj.items[0]["volumeInfo"]["authors"][0]);
    document.getElementById('title').value=json_obj.items[0]["volumeInfo"]["title"];
    document.getElementById('date_published').value=json_obj.items[0]["volumeInfo"]["publishedDate"];

    var textToFind = json_obj.items[0]["volumeInfo"]["authors"][0];

    var dd = document.getElementById('authors');
    for (var i = 0; i < dd.options.length; i++) {
        if (dd.options[i].text === textToFind) {
            dd.selectedIndex = i;
            break;
        }
    }

    var textToFind = json_obj.items[0]["volumeInfo"]["publisher"];

    var dd = document.getElementById('publishers');
    for (var i = 0; i < dd.options.length; i++) {
        if (dd.options[i].text === textToFind) {
            dd.selectedIndex = i;
            break;
        }
    }
}
