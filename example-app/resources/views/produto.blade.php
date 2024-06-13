<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('produto.store')}}" method="POST">
        @csrf
        
        
        <label>Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="Nome do produto" <required><br><br>

        <label>categoria:</label> 
        <input type="text" name="categoria_id" id="categoria_id"<required><br><br>

        <label>quantidade:</label> 
        <input type="text" name="quantidade" id="quantidade"
        required><br><br>
        <button type="submit">Cadastrar</button>
    
    </form>
</body>
</html>