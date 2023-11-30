document.addEventListener("DOMContentLoaded", function () {

    let btnEliminarCategoria = document.querySelectorAll(".btnEliminarCategoria");
  
    function eliminarCategoria(idCategoria) {
      // Aquí puedes hacer lo que quieras con el idProducto
      
      Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarlo",
      }).then((result) => {
        if (result.isConfirmed) {
          // Llamamos al método PHP para eliminar el usuario
          window.location = "index.php?pagina=categorias&id_categoria=" + idCategoria;
        }
      });
      // Llamamos al método PHP para eliminar el producto
     
    }
  
    btnEliminarCategoria.forEach(function (btn) {
      btn.addEventListener("click", function () {
        let idCategoria = this.getAttribute("data-id");
  
        
          eliminarCategoria(idCategoria);
        
      });
    });

    let btnEliminarProducto = document.querySelectorAll(".btnEliminarProducto");
  
    function eliminarProducto(idProducto) {
      // Aquí puedes hacer lo que quieras con el idProducto
      
      Swal.fire({
        title: "¿Estás seguro que desea eliminar el producto?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarlo",
      }).then((result) => {
        if (result.isConfirmed) {
          // Llamamos al método PHP para eliminar el usuario
          window.location = "index.php?pagina=productos&id_producto=" + idProducto;
        }
      });
      // Llamamos al método PHP para eliminar el producto
     
    }
  
    btnEliminarProducto.forEach(function (btn) {
      btn.addEventListener("click", function () {
        let idProducto = this.getAttribute("data-id");
  
        
          eliminarProducto(idProducto);
        
      });
    });

    let btnEliminarEstadoCivil = document.querySelectorAll(".btnEliminarEstadoCivil");
  
    function eliminarEstadoCivil(idEstadoCivil) {
      // Aquí puedes hacer lo que quieras con el idProducto
      console.log("ID del estado civil eliminado:", idEstadoCivil);
      Swal.fire({
        title: "¿Estás seguro que desea eliminar el Estado Civil?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarlo",
      }).then((result) => {
        if (result.isConfirmed) {
          // Llamamos al método PHP para eliminar el usuario
          window.location = "index.php?pagina=estadocivil&id_estado_civil=" + idEstadoCivil;
        }
      });
      // Llamamos al método PHP para eliminar el producto
     
    }
  
      btnEliminarEstadoCivil.forEach(function (btn) {
      btn.addEventListener("click", function () {
        let idEstadoCivil = this.getAttribute("data-id");
  
        
          eliminarEstadoCivil(idEstadoCivil);
        
      });
    });
  
    let btnEliminarCliente = document.querySelectorAll(".btnEliminarCliente");
  
    function eliminarClienteCliente(idCliente) {
      // Aquí puedes hacer lo que quieras con el idCliente
      console.log("ID del Cliente eliminado:", idCliente);
  
      Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarlo",
      }).then((result) => {
        if (result.isConfirmed) {
          // Llamamos al método PHP para eliminar el cliente
          window.location = "index.php?pagina=clientes&id_cliente=" + idCliente;
        }
      });
    }
  
    btnEliminarCliente.forEach(function (btn) {
      btn.addEventListener("click", function () {
        let idCliente = this.getAttribute("data-id");
  
        
          eliminarClienteCliente(idCliente);
        
      });
    });
  
    // Código corregido para el botón `btnEliminarUsuario`
    let btnEliminarUsuario = document.querySelectorAll(".btnEliminarUsuario");
  
    function eliminarUsuario(idUsuario) {
      // Aquí puedes hacer lo que quieras con el idCliente
      console.log("ID del Usuario eliminado:", idUsuario);
  
      Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarlo",
      }).then((result) => {
        if (result.isConfirmed) {
          // Llamamos al método PHP para eliminar el usuario
          window.location = "index.php?pagina=usuarios&id_usuario=" + idUsuario;
        }
      });
    }
  
    btnEliminarUsuario.forEach(function (btn) {
      btn.addEventListener("click", function () {
        let idUsuario = this.getAttribute("data-id");
  
        eliminarUsuario(idUsuario);
      });
    });

  });