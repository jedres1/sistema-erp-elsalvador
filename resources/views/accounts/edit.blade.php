<div id="edit-account-form">
    <h2>Editar Cuenta</h2>
    <form id="form-edit-account" onsubmit="submitEditAccount(event)">
        <input type="hidden" id="account-id">
        <div>
            <label for="account-description">Descripción:</label>
            <input type="text" id="account-description">
        </div>
        <div>
            <label for="account-type">Tipo de Cuenta:</label>
            <select id="account-type">
                <option value="A">Activo</option>
                <option value="P">Pasivo</option>
                <option value="K">Capital</option>
                <option value="I">Ingreso</option>
                <option value="G">Gasto</option>
            </select>
        </div>
        <!-- Agrega otros campos según sea necesario -->
        <button type="submit">Guardar</button>
    </form>
</div>

