import React, { useEffect, useMemo, useState } from "react";
import axios from "axios";
import { useTable } from "react-table";

const TestPage = () => {
  const [data, setData] = useState([]);
  const [selectedData, setSelectedData] = useState([]);
  const [editedData, setEditedData] = useState({});
  const [showModal, setShowModal] = useState(false);

  useEffect(() => {
    axios
      .get("https://jsonplaceholder.typicode.com/users") // Ganti dengan URL API yang sesuai
      .then((response) => setData(response.data))
      .catch((error) => console.log(error));
  }, []);

  const columns = useMemo(
    () => [
      { Header: "No.", accessor: (row, index) => index + 1 },
      { Header: "ID", accessor: "id" },
      { Header: "Nama", accessor: "name" },
      { Header: "Email", accessor: "email" },
      {
        Header: "Aksi",
        accessor: "id",
        id: "aksiKedua",
        Cell: ({ row }) => (
          <button
            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            onClick={() => handleMoveToSecondTable(row.original)}
          >
            Pindah ke Tabel 2
          </button>
        ),
      },
    ],
    []
  );

  const secondTableColumns = useMemo(
    () => [
      { Header: "No.", accessor: (row, index) => index + 1 },
      { Header: "ID", accessor: "id" },
      { Header: "Nama", accessor: "name" },
      { Header: "Email", accessor: "email" },
      {
        Header: "Aksi",
        accessor: "id",
        id: "aksiPertama",
        Cell: ({ row }) => (
          <>
            <button
              className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2"
              onClick={() => handleEditData(row.original)}
            >
              Edit
            </button>
            <button
              className="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
              onClick={() => handleMoveToFirstTable(row.original)}
            >
              Pindah ke Tabel 1
            </button>
          </>
        ),
      },
    ],
    []
  );

  const tableInstance = useTable({ columns, data });
  const secondTableInstance = useTable({
    columns: secondTableColumns,
    data: selectedData,
  });

  const { getTableProps, getTableBodyProps, headerGroups, rows, prepareRow } =
    tableInstance;
  const {
    getTableProps: getSecondTableProps,
    getTableBodyProps: getSecondTableBodyProps,
    headerGroups: secondTableHeaderGroups,
    rows: secondTableRows,
    prepareRow: prepareSecondTableRow,
  } = secondTableInstance;

  const handleMoveToSecondTable = (item) => {
    setSelectedData((prevData) => [...prevData, item]);
    setData((prevData) =>
      prevData.filter((dataItem) => dataItem.id !== item.id)
    );
  };

  const handleMoveToFirstTable = (item) => {
    setData((prevData) => [...prevData, item]);
    setSelectedData((prevData) =>
      prevData.filter((dataItem) => dataItem.id !== item.id)
    );
  };

  const handleEditData = (item) => {
    setEditedData(item);
    setShowModal(true);
  };

  const handleModalClose = () => {
    setEditedData({});
    setShowModal(false);
  };

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setEditedData((prevData) => ({ ...prevData, [name]: value }));
  };

  const handleSaveChanges = () => {
    // Kirim data yang diubah ke API
    axios
      .put(
        `https://jsonplaceholder.typicode.com/users/${editedData.id}`,
        editedData
      )
      .then((response) => {
        // Perbarui data di tabel kedua
        const updatedData = selectedData.map((item) =>
          item.id === editedData.id ? response.data : item
        );
        setSelectedData(updatedData);
        setShowModal(false);
      })
      .catch((error) => console.log(error));
  };

  return (
    <div className="container mx-auto px-4">
      <div className="grid grid-rows-3 gap-8">
        <div>
          <h2 className="text-lg font-bold mb-4">Tabel Pertama</h2>
          <table {...getTableProps()} className="table-auto w-full">
            <thead>
              {headerGroups.map((headerGroup) => (
                <tr {...headerGroup.getHeaderGroupProps()}>
                  {headerGroup.headers.map((column) => (
                    <th {...column.getHeaderProps()} className="px-4 py-2">
                      {column.render("Header")}
                    </th>
                  ))}
                </tr>
              ))}
            </thead>
            <tbody {...getTableBodyProps()}>
              {rows.map((row) => {
                prepareRow(row);
                return (
                  <tr {...row.getRowProps()}>
                    {row.cells.map((cell) => (
                      <td {...cell.getCellProps()} className="border px-4 py-2">
                        {cell.render("Cell")}
                      </td>
                    ))}
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
        <div>
          <h2 className="text-lg font-bold mb-4">Tabel Kedua</h2>
          <table {...getSecondTableProps()} className="table-auto w-full">
            <thead>
              {secondTableHeaderGroups.map((headerGroup) => (
                <tr {...headerGroup.getHeaderGroupProps()}>
                  {headerGroup.headers.map((column) => (
                    <th {...column.getHeaderProps()} className="px-4 py-2">
                      {column.render("Header")}
                    </th>
                  ))}
                </tr>
              ))}
            </thead>
            <tbody {...getSecondTableBodyProps()}>
              {secondTableRows.map((row) => {
                prepareSecondTableRow(row);
                return (
                  <tr {...row.getRowProps()}>
                    {row.cells.map((cell) => (
                      <td {...cell.getCellProps()} className="border px-4 py-2">
                        {cell.render("Cell")}
                      </td>
                    ))}
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
      </div>

      {showModal && (
        <div className="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
          <div className="bg-white w-1/2 rounded p-4">
            <h2 className="text-lg font-bold mb-4">Edit Data</h2>
            <div className="flex flex-col space-y-4">
              <input
                type="text"
                name="name"
                value={editedData.name || ""}
                onChange={handleInputChange}
                placeholder="Nama"
                className="border border-gray-300 rounded px-4 py-2"
              />
              <input
                type="text"
                name="email"
                value={editedData.email || ""}
                onChange={handleInputChange}
                placeholder="Email"
                className="border border-gray-300 rounded px-4 py-2"
              />
              <div className="flex justify-end">
                <button
                  className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                  onClick={handleSaveChanges}
                >
                  Simpan
                </button>
                <button
                  className="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded ml-2"
                  onClick={handleModalClose}
                >
                  Batal
                </button>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default TestPage;
