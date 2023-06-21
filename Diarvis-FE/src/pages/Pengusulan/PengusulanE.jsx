import React, { useContext, useMemo, useEffect, useState } from "react";
import { useTable, usePagination, useBlockLayout } from "react-table";
import { useSticky } from "react-table-sticky";
import {
  AiOutlineDoubleLeft,
  AiOutlineDoubleRight,
  AiOutlineRight,
  AiOutlineLeft,
  AiOutlineArrowDown,
  AiOutlineDelete,
} from "react-icons/ai";
import { BiUpload } from "react-icons/bi";
import Layout from "../../layout/layout";
import MOCK_DATA from "../../components/Table/DataMaster/MOCK_DATA.json";
import { COLUMNS_E_API } from "../../components/Table/DataMaster/columns";
import { UserContext } from "../../App";
import { useNavigate, useLocation } from "react-router-dom";
import axios from "axios";
import Swal from "sweetalert2";
import { Spinner } from "flowbite-react";
import Footer from "../../components/Layout/Footer";

const PengusulanB = () => {
  // const location = useLocation();
  //   const isLoggedIn = useContext(UserContext);
  const [isLoading, setIsLoading] = useState(false);
  const [DataTable, setDataTable] = useState([]);
  const [dataByUPB, setDataByUPB] = useState([]);
  const [selectedData, setSelectedData] = useState([]);
  const [idBarang, setIdBarang] = useState();
  const [editedData, setEditedData] = useState({});
  const [showModal, setShowModal] = useState(false);
  const [alasanPenghapusan, setAlasanPenghapusan] = useState();
  const [file1, setFile1] = useState(null);
  const [file2, setFile2] = useState(null);
  const [file3, setFile3] = useState(null);
  const [file4, setFile4] = useState(null);
  const dataUser = JSON.parse(sessionStorage.getItem("user"));
  const codeFilterUpb = `${dataUser.kode_bidang}/${dataUser.kode_unit}/${dataUser.kode_sub_unit}/${dataUser.kode_upb}`;
  const formData = {
    id_user: dataUser.id_user,
    id_aset_e: idBarang,
    alasan_penghapusan: alasanPenghapusan,
    foto_barang1: file1,
    foto_barang2: file2,
    foto_barang3: file3,
    foto_barang4: file4,
  };

  const fetchData = async () => {
    const response = await axios
      .get(`http://localhost:8000/api/kibe/belumUsulan/${codeFilterUpb}`)
      // .get(`http://localhost:8000/api/kibb/belumUsulan/`)
      .catch((err) => console.log(err));

    if (response) {
      const DataTable = response.data.data;
      console.log("data: ", response);
      setDataByUPB(DataTable);
    }
  };

  // Table Property (using dummy)
  // const columns = useMemo(() => COLUMNS_B, []);
  // const data = useMemo(() => MOCK_DATA, []);

  // Table Property (using API)
  const columns = useMemo(() => COLUMNS_E_API, []);
  const data = useMemo(() => [...dataByUPB], [dataByUPB]);

  // Table Property 2 (using API)
  const secondColumns = useMemo(() => COLUMNS_E_API, []);
  const secondData = useMemo(() => [...selectedData], [selectedData]);

  const tableHooks = (hooks) => {
    hooks.visibleColumns.push((columns) => [
      ...columns,
      {
        id: "Aksi",
        accessor: "id",
        Header: "Aksi",
        sticky: "right",
        width: 80,
        Cell: ({ row }) => (
          <div className="flex justify-center ml-2">
            <button
              title="Tandai Barang"
              className="px-3 py-2 text-xs mr-2 font-medium text-center rounded-md text-white bg-yellow-300 hover:bg-yellow-400"
              onClick={() => handleMoveToSecondTable(row.original)}
            >
              <AiOutlineArrowDown />
            </button>
          </div>
        ),
      },
    ]);
  };

  const secondTableHooks = (hooks) => {
    hooks.visibleColumns.push((columns) => [
      ...columns,
      {
        id: "Aksi",
        accessor: "id",
        Header: "Aksi",
        sticky: "right",
        width: 100,
        Cell: ({ row }) => (
          <div className="flex justify-center ml-2">
            <button
              title="Usulkan"
              className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded mr-2"
              onClick={() => handleInputPengusulan(row.original.id_aset_e)}
            >
              <BiUpload />
            </button>
            <button
              title="Batal Tandai Barang"
              className="px-3 text-xs mr-2 font-medium text-center rounded-md text-white bg-red-500 hover:bg-red-700"
              onClick={() => handleMoveToFirstTable(row.original)}
            >
              <AiOutlineDelete />
            </button>
          </div>
        ),
      },
    ]);
  };

  const tableInstance = useTable(
    { columns, data },
    useBlockLayout,
    useSticky,
    usePagination,
    tableHooks
  );
  const secondTableInstance = useTable(
    {
      columns: secondColumns,
      data: secondData,
    },
    useBlockLayout,
    useSticky,
    usePagination,
    secondTableHooks
  );

  const {
    getTableProps,
    getTableBodyProps,
    headerGroups,
    page,
    nextPage,
    previousPage,
    canNextPage,
    canPreviousPage,
    pageOptions,
    gotoPage,
    pageCount,
    setPageSize,
    state,
    prepareRow,
  } = tableInstance;

  const {
    getTableProps: getSecondTableProps,
    getTableBodyProps: getSecondTableBodyProps,
    headerGroups: secondTableHeaderGroups,
    page: secondTablePage,
    nextPage: secondTableNextPage,
    previousPage: secondTablePreviousPage,
    canNextPage: secondTableCanNextPage,
    canPreviousPage: secondTableCanPreviousPage,
    pageOptions: secondTablePageOptions,
    gotoPage: secondTableGotoPage,
    pageCount: secondTablePageCount,
    setPageSize: secondTableSetPageSize,
    state: secondTableState,
    prepareRow: secondTablePrepareRow,
  } = secondTableInstance;

  const handleMoveToSecondTable = (item) => {
    setSelectedData((prevData) => [...prevData, item]);
    setDataByUPB((prevData) =>
      prevData.filter((dataItem) => dataItem.id_aset_e !== item.id_aset_e)
    );
  };

  const handleMoveToFirstTable = (item) => {
    setDataByUPB((prevData) => [...prevData, item]);
    setSelectedData((prevData) =>
      prevData.filter((dataItem) => dataItem.id_aset_e !== item.id_aset_e)
    );
  };

  const handleInputPengusulan = (item) => {
    setIdBarang(item);
    setShowModal(true);
  };

  const handleModalClose = () => {
    setIdBarang();
    setAlasanPenghapusan();
    setFile1(null);
    setFile2(null);
    setFile3(null);
    setFile4(null);
    setShowModal(false);
  };

  const handleSubmitUsulan = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    try {
      const config = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      };
      const dataUsulan = await axios
        .post("http://localhost:8000/api/kibe/usulan", formData, config)
        .then((res) => {
          console.log(res);
          setIsLoading(false);
          Swal.fire({
            icon: "success",
            title: "Pengusulan Berhasil",
            text: "Barang berhasil diusulkan!",
          }).then(function () {
            handleModalClose();
          });
        });
    } catch (error) {
      console.log(error);
      setIsLoading(false);
      Swal.fire({
        icon: "error",
        title: "Pengusulan Gagal",
        text: "Barang gagal diusulkan!",
      }).then(function () {
        handleModalClose();
      });
    }
  };

  const { pageIndex, pageSize } = state;

  const { secondTablePageIndex, secondTablePageSize } = state;

  useEffect(() => {
    fetchData();
  }, []);

  return (
    <>
      <div className="z-50">
        <Layout />
        <div className="min-h-screen">
          <div className="flex flex-col lg:ml-64 pt-[8.7rem] px-5 w-auto">
            <div className="block p-6 bg-white border border-gray-200 rounded-lg shadow">
              <h5 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Pengusulan / KIB E
              </h5>
              <div className="relative overflow-x-auto border border-gray-300">
                <table
                  className="table-fixed w-full text-sm text-center text-gray-500 border-collapse"
                  {...getTableProps()}
                >
                  <thead className="header text-xs text-gray-900 uppercase bg-gray-50">
                    {headerGroups.map((headerGroup) => (
                      <tr {...headerGroup.getHeaderGroupProps()}>
                        {headerGroup.headers.map((column) => (
                          <th
                            scope="col"
                            className="overflow-hidden bg-gray-50 px-2 py-2 border border-slate-300"
                            {...column.getHeaderProps()}
                          >
                            {column.render("Header")}
                          </th>
                        ))}
                      </tr>
                    ))}
                  </thead>
                  <tbody
                    className="body text-2xs text-gray-900"
                    {...getTableBodyProps()}
                  >
                    {page.map((row) => {
                      prepareRow(row);
                      return (
                        <tr className="" {...row.getRowProps()}>
                          {row.cells.map((cell) => {
                            return (
                              <td
                                className="px-2 py-2 border last:bg-slate-50 border-slate-300"
                                {...cell.getCellProps()}
                              >
                                {cell.render("Cell")}
                              </td>
                            );
                          })}
                        </tr>
                      );
                    })}
                  </tbody>
                </table>
              </div>
              <nav
                className="flex items-center justify-between pt-4"
                aria-label="Table navigation"
              >
                <div className="inline-flex items-center">
                  <span className="text-sm font-normal mr-3 text-gray-500 dark:text-gray-400">
                    Rows per page
                  </span>
                  <select
                    id="underline_select"
                    className="block py-2.5 px-0 w-16 text-sm text-center text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                    value={pageSize}
                    onChange={(e) => setPageSize(Number(e.target.value))}
                  >
                    {[10, 25, 50].map((pageSize) => (
                      <option key={pageSize} value={pageSize}>
                        {pageSize}
                      </option>
                    ))}
                  </select>
                </div>
                <span className="text-sm font-normal text-gray-500 dark:text-gray-400">
                  Page{" "}
                  <span className="font-semibold text-gray-900 dark:text-white">
                    {state.pageIndex + 1}
                  </span>{" "}
                  of{" "}
                  <span className="font-semibold text-gray-900 dark:text-white">
                    {pageOptions.length}
                  </span>
                </span>
                <ul className="inline-flex items-center -space-x-px">
                  <li>
                    <button
                      className="block px-3 py-2 mr-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg disabled:text-gray-300 disabled:border-gray-200 enabled:hover:bg-gray-100"
                      onClick={() => gotoPage(0)}
                      disabled={!canPreviousPage}
                    >
                      <span className="sr-only">First</span>

                      <AiOutlineDoubleLeft />
                    </button>
                  </li>
                  <li>
                    <button
                      className="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300  disabled:text-gray-300 disabled:border-gray-200 enabled:hover:bg-gray-100"
                      onClick={() => previousPage()}
                      disabled={!canPreviousPage}
                    >
                      <span className="sr-only">Previous</span>
                      <AiOutlineLeft />
                    </button>
                  </li>
                  <li>
                    <button
                      className="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 disabled:text-gray-300 disabled:border-gray-200 enabled:hover:bg-gray-100"
                      onClick={() => nextPage()}
                      disabled={!canNextPage}
                    >
                      <span className="sr-only">Next</span>
                      <AiOutlineRight />
                    </button>
                  </li>
                  <li>
                    <button
                      className="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg disabled:text-gray-300 disabled:border-gray-200 enabled:hover:bg-gray-100"
                      onClick={() => gotoPage(pageCount - 1)}
                      disabled={!canNextPage}
                    >
                      <span className="sr-only">Last</span>
                      <AiOutlineDoubleRight />
                    </button>
                  </li>
                </ul>
              </nav>
            </div>
            <div className="block p-6 pb-10 mt-8 bg-white border border-gray-200 rounded-lg shadow">
              <h5 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Ditandai
              </h5>
              <div className="relative overflow-x-auto border border-gray-300">
                <table
                  className="table-fixed w-full text-sm text-center text-gray-500 border-collapse"
                  {...getSecondTableProps()}
                >
                  <thead className="header text-xs text-gray-900 uppercase bg-gray-50">
                    {secondTableHeaderGroups.map((secondTableHeaderGroups) => (
                      <tr {...secondTableHeaderGroups.getHeaderGroupProps()}>
                        {secondTableHeaderGroups.headers.map((column) => (
                          <th
                            scope="col"
                            className="overflow-hidden bg-gray-50 px-2 py-2 border border-slate-300"
                            {...column.getHeaderProps()}
                          >
                            {column.render("Header")}
                          </th>
                        ))}
                      </tr>
                    ))}
                  </thead>
                  <tbody
                    className="body text-2xs text-gray-900"
                    {...getSecondTableBodyProps()}
                  >
                    {secondTablePage.map((row) => {
                      secondTablePrepareRow(row);
                      return (
                        <tr className="" {...row.getRowProps()}>
                          {row.cells.map((cell) => {
                            return (
                              <td
                                className="px-2 py-2 border bg-white border-slate-300"
                                {...cell.getCellProps()}
                              >
                                {cell.render("Cell")}
                              </td>
                            );
                          })}
                        </tr>
                      );
                    })}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          {showModal && (
            <div className="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 z-[60]">
              <div className="bg-white lg:w-auto xl:w-10/12 2xl:w-8/12  rounded p-8">
                {isLoading && (
                  <>
                    <div className="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 z-[60]">
                      <Spinner
                        aria-label="Extra large spinner example"
                        size="xl"
                      />
                    </div>
                  </>
                )}
                <form>
                  <div class="mb-6">
                    <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                      Form Pengusulan
                    </h5>
                  </div>
                  <div class="mb-6">
                    <label
                      for="alasan"
                      class="block mb-2 text-sm font-medium text-gray-900"
                    >
                      Alasan
                    </label>
                    <textarea
                      type="deskripsi"
                      id="deskripsi"
                      value={alasanPenghapusan}
                      onChange={(e) => setAlasanPenghapusan(e.target.value)}
                      rows="3"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 "
                      placeholder="Masukkan Deskripsi atau keterangan"
                      required
                    />
                  </div>
                  <div class="mb-6">
                    <h5 className="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                      Upload Foto
                    </h5>
                  </div>
                  <div className="mt-5 grid lg:grid-cols-2 grid-rows-2 gap-10">
                    <div className="flex flex-row items-center justify-between">
                      <label
                        class="mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="file_input"
                      >
                        Tampak Depan
                      </label>
                      <input
                        class="w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                        id="file_input"
                        type="file"
                        accept="image/*"
                        onChange={(e) => setFile1(e.target.files[0])}
                      />
                    </div>
                    <div className="flex flex-row items-center justify-between">
                      <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="file_input"
                      >
                        Tampak Kanan
                      </label>
                      <input
                        class="block w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                        id="file_input"
                        type="file"
                        accept="image/*"
                        onChange={(e) => setFile2(e.target.files[0])}
                      />
                    </div>
                    <div className="flex flex-row items-center justify-between">
                      <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="file_input"
                      >
                        Tampak Belakang
                      </label>
                      <input
                        class="block w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                        id="file_input"
                        type="file"
                        accept="image/*"
                        onChange={(e) => setFile3(e.target.files[0])}
                      />
                    </div>
                    <div className="flex flex-row items-center justify-between">
                      <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="file_input"
                      >
                        Tampak Kiri
                      </label>
                      <input
                        class="block w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                        id="file_input"
                        type="file"
                        accept="image/*"
                        onChange={(e) => setFile4(e.target.files[0])}
                      />
                    </div>
                  </div>
                </form>
                <div className="flex justify-end mt-8">
                  <button
                    className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    onClick={handleSubmitUsulan}
                  >
                    Usulkan
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
          )}
        </div>
      </div>
      <Footer />
    </>
  );
};

export default PengusulanB;
