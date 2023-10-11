const dataTable = new DataTable("#datatable");
const formDelete = document.querySelectorAll(".formDelete");

dataTable.on("submit", "td form.formDelete", async function (e) {
  e.preventDefault();

  const { isConfirmed } = await Swal.fire({
    title: "Yakin ingin menghapus transaksi?",
    text: "transaksi akan terhapus selamanya!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes",
  });

  if (isConfirmed) {
    e.currentTarget.submit();
  }
});
