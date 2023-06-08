export const COLUMNS_B = [
  {
    Header: "No",
    accessor: (row, i) => i + 1,
    width: 40,
    Cell: ({ value }) => <div>{value}</div>,
  },
  {
    Header: "id Pemda",
    // accessor: "id_pemda",
    width: 140,
    Cell: ({row}) => <p>{row.original.no_register} . {row.original.nama_aset}</p>,
  },
  {
    Header: "Nama Aset",
    accessor: "nama_aset",
    width: 200,
  },
  {
    Header: "Kode Aset",
    accessor: "kode_aset",
    width: 140,
  },
  {
    Header: "No register",
    accessor: "no_register",
    width: 95,
  },
  {
    Header: "Tanggal Perolehan",
    accessor: "tgl_perolehan",
    width: 160,
  },
  {
    Header: "Tanggal Pembukuan",
    accessor: "tgl_pembukuan",
    width: 160,
  },
  {
    Header: "Merek",
    accessor: "merek",
    width: 100,
  },
  {
    Header: "Type",
    accessor: "tipe",
    width: 160,
  },
  {
    Header: "CC",
    accessor: "cc",
    width: 60,
  },
  {
    Header: "Bahan",
    accessor: "bahan",
    width: 100,
  },
  {
    Header: "No Pabrik",
    accessor: "no_pabrik",
    width: 140,
  },
  {
    Header: "No Rangka",
    accessor: "no_rangka",
    width: 160,
  },
  {
    Header: "No Mesin",
    accessor: "no_mesin",
    width: 140,
  },
  {
    Header: "No Polisi",
    accessor: "no_polisi",
    width: 140,
  },
  {
    Header: "No BPKB",
    accessor: "no_bpkb",
    width: 140,
  },
  {
    Header: "Asal Usul",
    accessor: "asal_usul",
    width: 100,
  },
  {
    Header: "Kondisi",
    accessor: "kondisi",
    width: 100,
  },
  {
    Header: "Harga",
    accessor: "harga",
    width: 150,
  },
  {
    Header: "masa Manfaat",
    accessor: "masa_manfaat",
    width: 150,
  },
  {
    Header: "Nilai Sisa",
    accessor: "nilai_sisa",
    width: 140,
  },
  {
    Header: "Keterangan",
    accessor: "keterangan",
    width: 300,
  },
];

export const COLUMNS_E = [
  {
    Header: "No",
    accessor: "id",
    width: 40,
  },
  {
    Header: "id Pemda",
    accessor: "id_pemda",
    width: 140,
  },
  {
    Header: "Nama Aset",
    accessor: "nama_aset",
    width: 200,
  },
  {
    Header: "Kode Aset",
    accessor: "kode_aset",
    width: 140,
  },
  {
    Header: "No register",
    accessor: "no_register",
    width: 95,
  },
  {
    Header: "Tanggal Pembelian",
    accessor: "tgl_perolehan",
    width: 160,
  },
  {
    Header: "Tanggal Pembukuan",
    accessor: "tgl_pembukuan",
    width: 160,
  },
  {
    Header: "Judul",
    accessor: "judul",
    width: 160,
  },
  {
    Header: "Pencipta",
    accessor: "pencipta",
    width: 150,
  },
  {
    Header: "Bahan",
    accessor: "bahan",
    width: 100,
  },
  {
    Header: "Ukuran",
    accessor: "ukuran",
    width: 100,
  },
  {
    Header: "Asal Usul",
    accessor: "asal_usul",
    width: 100,
  },
  {
    Header: "Kondisi",
    accessor: "kondisi",
    width: 100,
  },
  {
    Header: "Harga",
    accessor: "harga",
    width: 150,
  },
  {
    Header: "masa Manfaat",
    accessor: "masa_manfaat",
    width: 150,
  },
  {
    Header: "Nilai Sisa",
    accessor: "nilai_sisa",
    width: 140,
  },
  {
    Header: "Keterangan",
    accessor: "keterangan",
    width: 300,
  },
];

export const COLUMNS_B_API = [
  {
    Header: "No",
    accessor: (row, i) => i + 1,
    width: 40,
    Cell: ({ value }) => <div>{value}</div>,
  },
  {
    Header: "id Pemda",
    // accessor: "id_pemda",
    width: 140,
  },
  {
    Header: "Nama Aset",
    // accessor: "nama_aset",
    width: 200,
  },
  {
    Header: "Kode Aset",
    // accessor: "id_aset_b",
    width: 140,
    Cell: ({ row }) => (
      <p>
        {row.original.kd_aset8}.{row.original.kd_aset80}.
        {row.original.kd_aset81}.{row.original.kd_aset82}.
        {row.original.kd_aset83}.{row.original.kd_aset84}.
        {row.original.kd_aset85}
      </p>
    ),
  },
  {
    Header: "No register",
    // accessor: "no_register",
    width: 95,
  },
  {
    Header: "Tanggal Perolehan",
    accessor: "tgl_perolehan",
    width: 160,
  },
  {
    Header: "Tanggal Pembukuan",
    // accessor: "tgl_pembukuan",
    width: 160,
  },
  {
    Header: "Merek",
    accessor: "merk",
    width: 100,
  },
  {
    Header: "Type",
    // accessor: "tipe",
    width: 160,
  },
  {
    Header: "CC",
    accessor: "cc",
    width: 60,
  },
  {
    Header: "Bahan",
    accessor: "bahan",
    width: 100,
  },
  {
    Header: "No Pabrik",
    accessor: "nomor_pabrik",
    width: 140,
  },
  {
    Header: "No Rangka",
    // accessor: "nomor_rangka",
    width: 160,
  },
  {
    Header: "No Mesin",
    accessor: "nomor_mesin",
    width: 140,
  },
  {
    Header: "No Polisi",
    // accessor: "no_polisi",
    width: 140,
  },
  {
    Header: "No BPKB",
    // accessor: "no_bpkb",
    width: 140,
  },
  {
    Header: "Asal Usul",
    accessor: "asal_usul",
    width: 100,
  },
  {
    Header: "Kondisi",
    accessor: "kondisi",
    width: 100,
  },
  {
    Header: "Harga",
    accessor: "harga",
    width: 150,
  },
  {
    Header: "masa Manfaat",
    // accessor: "masa_manfaat",
    width: 150,
  },
  {
    Header: "Nilai Sisa",
    // accessor: "nilai_sisa",
    width: 140,
  },
  {
    Header: "Keterangan",
    // accessor: "keterangan",
    width: 300,
  },
];

export const COLUMNS_E_API = [
  {
    Header: "No",
    accessor: (row, i) => i + 1,
    width: 40,
    Cell: ({ value }) => <div>{value}</div>,
  },
  {
    Header: "id Pemda",
    accessor: "id_pemda",
    width: 140,
  },
  {
    Header: "Nama Aset",
    accessor: "nama_aset",
    width: 200,
  },
  {
    Header: "Kode Aset",
    // accessor: "kode_aset",
    width: 140,
    Cell: ({ row }) => (
      <p>
        {row.original.kd_aset8}.{row.original.kd_aset80}.
        {row.original.kd_aset81}.{row.original.kd_aset82}.
        {row.original.kd_aset83}.{row.original.kd_aset84}.
        {row.original.kd_aset85}
      </p>
    ),
  },
  {
    Header: "No register",
    accessor: "no_register",
    width: 95,
  },
  {
    Header: "Tanggal Pembelian",
    accessor: "tgl_perolehan",
    width: 160,
  },
  {
    Header: "Tanggal Pembukuan",
    accessor: "tgl_pembukuan",
    width: 160,
  },
  {
    Header: "Judul",
    accessor: "judul",
    width: 160,
  },
  {
    Header: "Pencipta",
    accessor: "pencipta",
    width: 150,
  },
  {
    Header: "Bahan",
    accessor: "bahan",
    width: 100,
  },
  {
    Header: "Ukuran",
    accessor: "ukuran",
    width: 100,
  },
  {
    Header: "Asal Usul",
    accessor: "asal_usul",
    width: 100,
  },
  {
    Header: "Kondisi",
    accessor: "kondisi",
    width: 100,
  },
  {
    Header: "Harga",
    accessor: "harga",
    width: 150,
  },
  {
    Header: "masa Manfaat",
    accessor: "masa_manfaat",
    width: 150,
  },
  {
    Header: "Nilai Sisa",
    accessor: "nilai_sisa",
    width: 140,
  },
  {
    Header: "Keterangan",
    accessor: "keterangan",
    width: 300,
  },
];

export const COLUMNS_USER = [
  {
    Header: "No",
    accessor: (row, i) => i + 1,
    width: 40,
    Cell: ({ value }) => <div>{value}</div>,
  },
  {
    Header: "NIP",
    accessor: "no_pegawai",
    width: 150,
  },
  {
    Header: "Nama",
    accessor: "nama_lengkap",
    width: 200,
  },
  {
    Header: "Email",
    accessor: "email",
    width: 200,
  },
  {
    Header: "NO. TELP",
    accessor: "no_hp",
    width: 120,
  },
  {
    Header: "Grup",
    accessor: "nama_grup",
    width: 150,
  },
  {
    Header: "Bidang",
    accessor: "nama_bidang",
    width: 200,
  },
  {
    Header: "Unit",
    accessor: "nama_unit",
    width: 250,
  },
  {
    Header: "Sub-Unit",
    accessor: "nama_sub_unit",
    width: 300,
  },
  {
    Header: "UPB",
    accessor: "nama_upb",
    width: 300,
  },
];