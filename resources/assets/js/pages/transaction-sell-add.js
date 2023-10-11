jQuery(function () {
  const optionDataTable = {
    lengthChange: false,
    bFilter: false,
    pageLength: 5,
    columns: [
      { data: "no" },
      { data: "kode_barang" },
      { data: "nama_barang" },
      { data: "harga" },
      { data: "jumlah" },
      { data: "total" },
      { data: "aksi" },
    ],
  };

  const dataTable = new DataTable("#datatable", optionDataTable);

  const barangDropDown = document.getElementById("barang");
  const hargaJualInput = document.getElementById("harga");
  const jumlahInput = document.getElementById("jumlah");
  const tambahItemButton = document.getElementById("btn_tambah_item");
  const simpanTransaksiButton = document.getElementById("btn_simpan_transaksi");
  const textStok = document.getElementById("stok");
  const textTotalTransaksi = document.getElementById("total_transaksi");
  const tanggalTrx = document.getElementById("tanggal_trx");

  let listDataPenjualan = [];
  let dataBarang = {};
  let nomor = 1;

  let totalTransaksi = 0;

  $("#barang").on("select2:select", async function (e) {
    try {
      const url = `http://localhost:8000/api/barang/${barangDropDown.value}`;

      const response = await fetch(url);
      const payload = await response.json();

      const { harga_jual, stok } = payload;
      dataBarang = payload;

      hargaJualInput.value = harga_jual;
      textStok.innerHTML = stok;
    } catch (error) {
      await Swal.fire("Error Server", error.message, "error");
    }
  });

  barangDropDown.addEventListener("change", async () => {
    try {
      const url = `http://localhost:8000/api/barang/${barangDropDown.value}`;

      const response = await fetch(url);
      const payload = await response.json();

      const { harga_jual, stok } = payload;
      dataBarang = payload;

      hargaJualInput.value = harga_jual;
      textStok.innerHTML = stok;
    } catch (error) {
      await Swal.fire("Error Server", error.message, "error");
    }
  });

  tambahItemButton.addEventListener("click", async () => {
    try {
      if (
        barangDropDown.value != "" &&
        hargaJualInput.value != "" &&
        jumlahInput.value != ""
      ) {
        const { id, harga_jual, nama, stok, kode } = dataBarang;
        const jumlahInputInt = parseInt(jumlahInput.value);

        if (jumlahInputInt > stok) {
          await Swal.fire(
            "Stok Kurang",
            "Jumlah tidak boleh lebih dari stok!",
            "error"
          );
        } else if (jumlahInputInt === 0) {
          await Swal.fire(
            "Jumlah kosong",
            "Jumlah harus lebih dari 0 !",
            "error"
          );
        } else {
          const total = jumlahInputInt * harga_jual;

          listDataPenjualan.push({
            id_barang: id,
            jumlah: jumlahInputInt,
          });

          dataTable.row
            .add(
              $(`
              <tr>
                <td>${nomor++}</td>
                <td>${kode}</td>
                <td>${nama}</td>
                <td>
                  <div class="d-flex justify-content-between font-monospace">
                    <span>Rp. </span>
                    <span>
                      ${Intl.NumberFormat("de-DE").format(harga_jual)}
                    </span>
                  </div>
                </td>
                <td class="text-end">${jumlahInputInt}</td>
                <td>
                  <div class="d-flex justify-content-between font-monospace">
                    <span>Rp. </span>
                    <span>
                      ${Intl.NumberFormat("de-DE").format(total)}
                    </span>
                  </div>
                </td>
                <td>
                  <button type="submit" class="btn btn-danger btn-sm delete" data-total="${total}">
                    <i class='bx bxs-trash-alt'></i>
                  </button>
                </td>
              </tr>
            `)
            )
            .draw();

          totalTransaksi += total;

          textTotalTransaksi.innerHTML =
            Intl.NumberFormat("de-DE").format(totalTransaksi);
          barangDropDown.value = "";
          $("#barang").select2("val", "");
          hargaJualInput.value = "";
          jumlahInput.value = "";
          textStok.innerHTML = "0";
          dataBarang = {};
        }
      } else {
        await Swal.fire(
          "Form Kosong",
          "Isi semua form terlebih dahulu!",
          "error"
        );
      }
    } catch (error) {
      await Swal.fire("Error Server", error.message, "error");
    }
  });

  dataTable.on("click", "td button.delete", async function (e) {
    const { isConfirmed } = await Swal.fire({
      title: "Hapus Barang",
      text: "Anda yakin menghapus barang ini?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#6e6e6e",
      confirmButtonText: "Hapus",
    });

    if (isConfirmed) {
      dataTable.row($(this).parents("tr")).remove().draw();
      const rowTotal = $(this).data("total");

      totalTransaksi -= rowTotal;
      textTotalTransaksi.innerHTML =
        Intl.NumberFormat("de-DE").format(totalTransaksi);
    }
  });

  simpanTransaksiButton.addEventListener("click", async () => {
    try {
      if (listDataPenjualan.length < 1) {
        await Swal.fire(
          "Data Kosong",
          "Isi data penjualan terlebih dahulu!",
          "error"
        );
      } else {
        const url = `http://localhost:8000/api/transaksi_penjualan`;

        const response = await fetch(url, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            barang: listDataPenjualan,
            tanggal_transaksi: tanggalTrx.value,
          }),
        });

        const payload = await response.json();

        if (response.ok) {
          await Swal.fire("Success", payload.message, "success");

          window.location.pathname = "/transaksi-penjualan";
        } else {
          await Swal.fire(payload.message, payload.additional_info, "error");
        }
      }
    } catch (error) {
      await Swal.fire("Error Server", error.message, "error");
    }
  });

  $(".select2").select2({
    placeholder: "Pilih Barang",
  });
});
