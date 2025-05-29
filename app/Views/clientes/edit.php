<?php include __DIR__ . '/../layout/header.php'; ?>
<?php include __DIR__ . '/../layout/aside.php'; ?>

<div class="ml-64 p-8 w-full">
    <h1 class="text-3xl font-bold mb-6">Editar Cliente</h1>
    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="/clientes/edit/<?php echo htmlspecialchars($this->cliente->id); ?>" method="POST">
            <div class="mb-4">
                <label for="cliente" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Cliente:</label>
                <input type="text" name="cliente" id="cliente" value="<?php echo htmlspecialchars($this->cliente->cliente); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Actualizar</button>
                <a href="/clientes" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>