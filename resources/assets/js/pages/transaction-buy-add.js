jQuery(function () {
  const optionDataTable = {
    lengthChange: false,
    bFilter: false,
    pageLength: 5,
    columns: [
      { data: "no" },
      { data: "nama_barang" },
      { data: "harga" },
      { data: "jumlah" },
      { data: "total" },
      { data: "aksi" },
    ],
  };

  const dataTable = new DataTable("#datatable", optionDataTable);

  const supplierDropDown = document.getElementById("supplier");
  const barangDropDown = document.getElementById("barang");
  const hargaBeliInput = document.getElementById("harga");
  const jumlahInput = document.getElementById("jumlah");
  const tambahItemButton = document.getElementById("btn_tambah_item");
  const simpanTransaksiButton = document.getElementById("btn_simpan_transaksi");
  const textStok = document.getElementById("stok");
  const textStokPlus = document.getElementById("stok_plus");
  const textTotalTransaksi = document.getElementById("total_transaksi");
  const tanggalTrx = document.getElementById("tanggal_trx");

  let listDataPembelian = [];
  let dataBarang = {};
  let nomor = 1;

  let totalTransaksi = 0;

  barangDropDown.addEventListener("change", async () => {
    try {
      const url = `http://localhost:8000/api/barang/${barangDropDown.value}`;

      const response = await fetch(url);
      const payload = await response.json();

      const { harga_beli, stok } = payload;
      dataBarang = payload;

      hargaBeliInput.value = harga_beli;
      textStok.innerHTML = stok;
    } catch (error) {
      await Swal.fire("Error Server", error.message, "error");
    }
  });

  supplierDropDown.addEventListener("change", async () => {
    try {
      const url = `http://localhost:8000/api/supplier/${supplierDropDown.value}`;

      const response = await fetch(url);
      const payload = await response.json();

      const barang = [
        '<option value="" hidden>Pilih Barang</option>',
        ...payload.map((b) => `<option value="${b.id}">${b.nama}</option>`),
      ];

      barangDropDown.innerHTML = barang.join("");
    } catch (error) {
      await Swal.fire("Error Server", error.message, "error");
    }
  });

  tambahItemButton.addEventListener("click", async () => {
    try {
      if (
        barangDropDown.value != "" &&
        hargaBeliInput.value != "" &&
        jumlahInput.value != ""
      ) {
        const { id, harga_beli, nama, stok } = dataBarang;
        const jumlahInputInt = parseInt(jumlahInput.value);

        if (jumlahInputInt === 0) {
          await Swal.fire(
            "Jumlah kosong",
            "Jumlah harus lebih dari 0 !",
            "error"
          );
        } else {
          const total = jumlahInputInt * harga_beli;

          listDataPembelian.push({
            id_barang: id,
            jumlah: jumlahInputInt,
          });

          dataTable.row
            .add(
              $(`
                <tr>
                  <td>${nomor++}</td>
                  <td>${nama}</td>
                  <td>
                    <div class="d-flex justify-content-between font-monospace">
                      <span>Rp. </span>
                      <span>
                        ${Intl.NumberFormat("de-DE").format(harga_beli)}
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
          hargaBeliInput.value = "";
          jumlahInput.value = "";
          textStok.innerHTML = "0";
          textStokPlus.innerHTML = "0";
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
      if (listDataPembelian.length < 1) {
        await Swal.fire(
          "Data Kosong",
          "Isi data penjualan terlebih dahulu!",
          "error"
        );
      } else {
        const url = `http://localhost:8000/api/transaksi_pembelian`;

        const response = await fetch(url, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            barang: listDataPembelian,
            tanggal_transaksi: tanggalTrx.value,
          }),
        });

        const payload = await response.json();

        if (response.ok) {
          await Swal.fire("Success", payload.message, "success");

          window.location.pathname = "/transaksi-pembelian";
        } else {
          await Swal.fire(payload.message, payload.additional_info, "error");
        }
      }
    } catch (error) {
      await Swal.fire("Error Server", error.message, "error");
    }
  });

  jumlahInput.addEventListener("keyup", async () => {
    textStokPlus.innerHTML = jumlahInput.value;
  });
});
