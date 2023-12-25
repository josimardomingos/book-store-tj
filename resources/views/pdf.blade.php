<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-widtj, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <h2>Book Store</h2>
        <p>Relação de acervo:</p>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('autor.entity') }}</th>

                    <th>{{ __('livro.entity.fields.titulo') }}</th>
                    <th>{{ __('livro.entity.fields.editora') }}</th>
                    <th>{{ __('livro.entity.fields.edicao') }}</th>
                    <th>{{ __('livro.entity.fields.anopublicacao') }}</th>
                    <th>{{ __('livro.entity.fields.valor') }}</th>
                    <th>{{ __('assunto.entity') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['livraria'] as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['nome'] }}</td>
                        <td>{{ $item['titulo'] }}</td>
                        <td>{{ $item['editora'] }}</td>
                        <td>{{ $item['edicao'] }}</td>
                        <td>{{ $item['anopublicacao'] }}</td>
                        <td>@toMoney($item['valor'])</td>
                        <td>{{ $item['assuntos'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

<style>
    @media dompdf {
        * {
            line-height: 1.2;
        }
    }
</style>

</html>
