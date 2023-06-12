import React, { useContext, useMemo, useEffect, useState } from "react";
import { useTable, usePagination, useBlockLayout } from "react-table";
import { useSticky } from "react-table-sticky";
import {
  AiOutlineDoubleLeft,
  AiOutlineDoubleRight,
  AiOutlineRight,
  AiOutlineLeft,
  AiFillFileText,
  AiFillPlusCircle,
} from "react-icons/ai";
import Layout from "../../layout/layout";
import MOCK_DATA from "../../components/Table/DataMaster/MOCK_DATA.json";
import {
  COLUMNS_B_API,
} from "../../components/Table/DataMaster/columns";
import { UserContext } from "../../App";
import { useNavigate, useLocation } from "react-router-dom";
import axios from "axios";

const DataMasterB = () => {
  const isLoggedIn = useContext(UserContext);
  const [DataTable, setDataTable] = useState([]);
  const navigate = useNavigate();
  const location = useLocation();
  const dataUser = JSON.parse(sessionStorage.getItem("user"));
  const codeFilterUpb = `${dataUser.kode_bidang}/${dataUser.kode_unit}/${dataUser.kode_sub_unit}/${dataUser.kode_upb}`;
  console.log("role: ", dataUser.kode_group);
  const fetchDataAdmin = async () => {
    const response = await axios
      .get(`http://localhost:8000/api/kib-b/${location.state}`)
      .catch((err) => console.log(err));

    if (response) {
      const DataTable = response.data.data;
      console.log("data: ", response);
      setDataTable(DataTable);
    }
  };

  const fetchDataUser = async () => {
    const response = await axios
      .get(`http://localhost:8000/api/kib-b/${codeFilterUpb}`)
      // .get(`http://localhost:8000/api/kib-b`)
      .catch((err) => console.log(err));

    if (response) {
      const DataTable = response.data.data;
      console.log("data: ", response);
      setDataTable(DataTable);
    }
  };

  // Table Property (using dummy)
  // const columns = useMemo(() => COLUMNS_B, []);
  // const data = useMemo(() => MOCK_DATA, []);

  // Table Property (using API)
  const columns = useMemo(() => COLUMNS_B_API, []);
  const data = useMemo(() => [...DataTable], [DataTable]);

  const openDetails = (data) => {
    navigate(`/datamaster/kib-b/detail/${data.id_aset_b}`, { state: data });
  };

  const tableHooks = (hooks) => {
    hooks.visibleColumns.push((columns) => [
      ...columns,
      {
        id: "Aksi",
        Header: "Aksi",
        sticky: "right",
        width: 80,
        Cell: ({ row }) => (
          <div className="flex justify-center ml-2">
            <button
              title="Detail"
              className="px-3 py-2 text-xs mr-2 font-medium text-center rounded-md text-white bg-yellow-300 hover:bg-yellow-400"
              onClick={() => openDetails(row.original)}
            >
              <AiFillFileText />
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
    if (dataUser.kode_group === 1) {
      fetchDataAdmin();
      console.log("admin");
    } else {
      fetchDataUser();
      console.log("user");
    }
  }, []);

  return (
    <>
      <Layout />
      <div className="flex flex-col  lg:ml-64 mt-[118px] px-5 pt-5 w-auto min-h-[52.688rem]">
        <div className="block p-6 bg-white border border-gray-200 rounded-lg shadow">
          <h5 className="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            Data Master / KIB B
          </h5>
          <a
            href={`http://localhost:8000/api/kibb/excel/${location.state}`}
            download
            className="px-3 py-2 text-xs ml-3 mb-3 font-medium text-center inline-flex rounded-md text-white bg-blue-500 hover:bg-blue-600"
          >
            <AiFillPlusCircle size={15} />
            &nbsp;&nbsp;Generate Laporan
          </a>
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
    </>
  );
};

export default DataMasterB;
