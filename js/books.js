const express = require('express');
const app = express();
const port = 4000;

app.use(express.json());

let books = [
    {
        "id" : 1,
        "buku" : "Sejarah Dunia yang Disembunyikan",
        "penulis" : "Jonathan Black",
        "genre" : "Literatur Kontroversial",
        "Tahun" : 2007
    }
];

app.get('/book', (req, res) => {
    res.json(books);
});

app.post('/book', (req, res) => {
    const newBook = req.body;
    newBook.id = books.length + 1;
    books.push(newBook);
    res.status(201).json(newBook);
});

app.delete('/book/:id', (req, res) => {
    const id = parseInt(req.params.id);
    books = books.filter(book => book.id !== id);
    res.status(204).send();
});

app.listen(port, () => {
    console.log(`Server berjalan di http://localhost:${port}`)
})