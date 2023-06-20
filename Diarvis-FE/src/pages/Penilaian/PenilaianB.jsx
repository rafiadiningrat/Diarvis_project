import React, { useContext, useMemo, useEffect, useState } from "react";
import { useTable, usePagination, useBlockLayout } from "react-table";
import { useSticky } from "react-table-sticky";
import {
  AiOutlineDoubleLeft,
  AiOutlineDoubleRight,
  AiOutlineRight,
  AiOutlineLeft,
  AiFillFileText,
} from "react-icons/ai";
import { BsFillClipboardPlusFill } from "react-icons/bs";
import Layout from "../../layout/layout";
import MOCK_DATA from "../../components/Table/DataMaster/MOCK_DATA.json";
import { COLUMNS_PENILAIAN_B_API } from "../../components/Table/DataMaster/columns";
import { UserContext } from "../../App";
import { useNavigate, useLocation } from "react-router-dom";
import axios from "axios";
import Swal from "sweetalert2";

const PenilaianB = () => {
  const isLoggedIn = useContext(UserContext);
  const [DataTable, setDataTable] = useState([]);
  const [idUsulan, setidUsulan] = useState();
  const [file, setFile] = useState(null);
  const [linkPostPenilaian, setLinkPostPenilaian] = useState();
  const [showModal, setShowModal] = useState(false);
  const [statusPenilaian, setstatusPenilaian] = useState(null);
  const [keteranganPenilaian, setKeteranganPenilaian] = useState();
  const navigate = useNavigate();
  const dataUser = JSON.parse(sessionStorage.getItem("user"));
  const codeFilterUpb = `${dataUser.kode_bidang}/${dataUser.kode_unit}/${dataUser.kode_sub_unit}/${dataUser.kode_upb}`;
  const formData = {
    keterangan_penilaian: keteranganPenilaian,
    dokumen_penilaian: file,
  };
  // console.log("form penilaian: ", formData);
  // console.log("id penilaian: ", idUsulan);
  console.log("link api", linkPostPenilaian);

  const fetchData = async () => {
    const response = await axios
    .get(`http://localhost:8000/api/kibb/penilaian/${codeFilterUpb}`)
    .catch((err) => console.log(err));
    if (response) {
      console.log("response: ", response);
      const data = response.data;
      setDataTable(data);
    }
  };
  
  // Table Property (using API)
  const columns = useMemo(() => COLUMNS_PENILAIAN_B_API, []);
  const data = useMemo(() => [...DataTable], [DataTable]);
  
  const handleRadioDiterima = (e) => {
    setstatusPenilaian(e.target.value === "true");
    setLinkPostPenilaian("http://localhost:8000/api/kibb/penilaian/diterima");
  };

  const handleRadioDitolak = (e) => {
    setstatusPenilaian(e.target.value === "false");
    setLinkPostPenilaian("http://localhost:8000/api/kibb/penilaian/ditolak");
  };

  const openDetails = (data) => {
    navigate(`/penilaian/kib-b/detail/${data.id_usulan_b}`, { state: data });
  };

  const handleInputPenilaian = (item) => {
    setidUsulan(item);
    setShowModal(true);
  };

  const handleModalClose = () => {
    setidUsulan();
    setFile(null);
    setstatusPenilaian(null);
    setKeteranganPenilaian();
    setLinkPostPenilaian();
    setShowModal(false);
  };

  const handleSubmitPenilaian = async (e) => {
    e.preventDefault();
    try {
      const config = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      };
      const dataPenilaian = await axios
        .post(`${linkPostPenilaian}/${idUsulan}`, formData, config)
        .then((res) => {
          console.log(res);
          Swal.fire({
            icon: "success",
            title: "Penilaian Berhasil",
            text: "Berhasil melakukan penilaian!",
          }).then(function () {
            handleModalClose();
            fetchData();
          });
        });
    } catch (error) {
      console.log(error);
      Swal.fire({
        icon: "error",
        title: "Penilaian Gagal",
        text: "Gagal melakukan penilaian!",
      }).then(function () {
        handleModalClose();
      });
    }
  };

  const tableHooks = (hooks) => {
    hooks.visibleColumns.push((columns) => [
      ...columns,
      {
        id: "Aksi",
        Header: "Aksi",
        sticky: "right",
        width: 100,
        Cell: ({ row }) => (
          <div className="flex justify-center ml-2">
            <button
              title="Detail"
              className="px-3 py-2 text-xs mr-2 font-medium text-center rounded-md text-white bg-yellow-300 hover:bg-yellow-400"
              onClick={() => openDetails(row.original)}
            >
              <AiFillFileText />
            </button>
            <button
              title="Penilaian"
              className="px-3 py-2 text-xs mr-2 font-medium text-center rounded-md text-white bg-green-400 hover:bg-green-500"
              onClick={() => handleInputPenilaian(row.original.id_usulan_b)}
            >
              <BsFillClipboardPlusFill />
            </button>
          </div>
        ),
      },
    ]);
  };

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
  } = useTable(
    {
      columns,
      data,
    },
    usePagination,
    tableHooks,
    useBlockLayout,
    useSticky
  );

  const { pageIndex, pageSize } = state;

  useEffect(() => {
    fetchData();
  }, []);

  return (
    <>
      <div className="z-50">
        <Layout />
        <div className="min-h-screen">
          <div className="flex flex-col  lg:ml-64 pt-[8.7rem] px-5 w-auto">
            <div className="block p-6 bg-white border border-gray-200 rounded-lg shadow">
              <h5 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Penilaian / KIB B
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
          </div>
          {showModal && (
            <div className="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 z-[60]">
              <div className="bg-white w-1/2 lg:w-1/4 rounded p-8">
                <form>
                  <div class="mb-6">
                    <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                      Form Penilaian
                    </h5>
                  </div>
                  <label
                    class="mb-2 text-sm font-semibold text-gray-900 dark:text-white"
                    for="file_input"
                  >
                    Pilih Status Penilaian
                  </label>
                  <div className="mt-6 mb-6 space-y-6">
                    <div className="flex items-center gap-x-3">
                      <input
                        id="push-diterima"
                        name="push-notifications"
                        type="radio"
                        value="true"
                        onChange={handleRadioDiterima}
                        className="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                      />
                      <label
                        htmlFor="push-diterima"
                        className="block text-sm font-medium leading-6 text-gray-900"
                      >
                        Diterima
                      </label>
                    </div>
                    <div className="flex items-center gap-x-3">
                      <input
                        id="push-ditolak"
                        name="push-notifications"
                        type="radio"
                        value="true"
                        onChange={handleRadioDitolak}
                        className="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                      />
                      <label
                        htmlFor="push-ditolak"
                        className="block text-sm font-medium leading-6 text-gray-900"
                      >
                        Ditolak
                      </label>
                    </div>
                  </div>
                  <div class="mb-6">
                    <label
                      for="alasan"
                      class="block mb-2 text-sm font-medium text-gray-900"
                    >
                      Keterangan
                    </label>
                    <textarea
                      type="deskripsi"
                      id="deskripsi"
                      value={keteranganPenilaian}
                      onChange={(e) => setKeteranganPenilaian(e.target.value)}
                      rows="3"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                      placeholder="Masukkan Deskripsi atau keterangan"
                      required
                    />
                  </div>

                  <div className="mt-5 grid grid-rows-2 gap-5">
                    <div className="flex flex-row items-center justify-between">
                      <label
                        class="block mb-2 text-sm font-semibold text-gray-900"
                        for="file_input"
                      >
                        Upload Dokumen
                      </label>
                    </div>
                    <div className="flex flex-row items-center justify-between">
                      <input
                        class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                        id="file_input"
                        type="file"
                        accept="application/pdf"
                        required
                        onChange={(e) => setFile(e.target.files[0])}
                      />
                    </div>
                  </div>
                </form>
                <div className="flex justify-end mt-8">
                  <button
                    className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    onClick={(e) => handleSubmitPenilaian(e)}
                  >
                    Submit
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
    </>
  );
};

export default PenilaianB;
