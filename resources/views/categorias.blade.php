<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Categorias</title>
</head>

<body>
    <label>Categorias:</label>
    <select id="idCategoria" class="form-select" aria-label="Default select example">
        <option selected>Selecione Categoria</option>
        @foreach ($categories as $category)
            <option value="{{ $category->category_id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <div class="container">
        <div id="lista" class="row">


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
        var obj;
        const libros = document.getElementById('lista');
        const select = document.getElementById('idCategoria');
        console.log(select);
        select.addEventListener('change', () => {
            fetch(`https://www.etnassoft.com/api/v1/get/?category_id=${select.value}&results_range=0,10`)
                .then((res) => res.json())
                .then((data) => {
                    console.log(data)
                    var contLibros = 1;
                    while (libros.firstChild) {
                        libros.removeChild(libros.firstChild)
                    }
                    data.forEach(i => {
                        console.log(i.title)
                        const libro = document.createElement('div');
                        libro.innerHTML = `
                        <div class="card" style="width: 18rem">
            <img src="${i.cover}" class="card-img-top" alt="..." />
            <div class="card-body">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#Libro-${contLibros}"
                >
                    Ver
                </button>
            </div>
        </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div
            class="modal fade"
            id="Libro-${contLibros++}"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Modal title
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <img src="${i.cover}" alt="" />
                        <label>title: ${i.title}</label>
                        <label>author: ${i.author}</label>
                        <label>content_short: ${i.content_short}</label>
                        <label>publisher_date: ${i.publisher_date}</label>
                        <label>pages: ${i.pages}</label>
                        <label>language: ${i.language}</label>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
                        `
                        libros.appendChild(libro);
                    });
                });
        })
    </script>
</body>

</html>
