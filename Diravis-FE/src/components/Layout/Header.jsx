import React from "react";
import { useNavigate } from "react-router-dom";

const Header = (props) => {
  const navigate = useNavigate();
  // const dataUser = JSON.parse(sessionStorage.getItem("user"));
  return (
    <>
      <div className="fixed top-0 z-50 w-full">
        <div className="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
          <div className="px-3 py-3 lg:px-5 lg:pl-3">
            <div className="flex items-center justify-between">
              <div className="flex items-center justify-center ">
                <button
                  data-drawer-target="logo-sidebar"
                  data-drawer-toggle="logo-sidebar"
                  aria-controls="logo-sidebar"
                  type="button"
                  className="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                >
                  <span className="sr-only">Open sidebar</span>
                  <svg
                    className="w-6 h-6"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      clipRule="evenodd"
                      fillRule="evenodd"
                      d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                    ></path>
                  </svg>
                </button>
                <img src="/images/Kabupaten Bandung.png" className="w-[4rem]" />
                <img src="/images/diarvis-logo.png" className="w-[10rem]" />
                <div className="invisible text-black ml-3 lg:visible">
                  Pemerintah Kabupaten Bandung / Sekwan / DPRD / Sekretariat
                  DPRD
                </div>
              </div>
              <div className="flex items-center">
                <div className="flex items-center ml-3 justify-end w-48 shrink">
                  <div>
                    <button
                      type="button"
                      className="flex text-sm "
                      aria-expanded="false"
                      data-dropdown-toggle="dropdown-user"
                    >
                      <div className="text-black">Akbar | Admin</div>
                    </button>
                  </div>
                  <div
                    className="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="dropdown-user"
                  >
                    <div className="px-4 py-3" role="none">
                      <p
                        className="text-sm text-gray-900 dark:text-white"
                        role="none"
                      >
                        Neil Sims
                      </p>
                      <p
                        className="text-sm font-medium text-gray-900 truncate dark:text-gray-300"
                        role="none"
                      >
                        neil.sims@flowbite.com
                      </p>
                    </div>
                    <ul className="py-1" role="none">
                      <li>
                        <a
                          href="#"
                          className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                          role="menuitem"
                        >
                          Dashboard
                        </a>
                      </li>
                      <li>
                        <a
                          href="#"
                          className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                          role="menuitem"
                        >
                          Settings
                        </a>
                      </li>
                      <li>
                        <a
                          href="#"
                          className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                          role="menuitem"
                        >
                          Earnings
                        </a>
                      </li>
                      <li>
                        <a
                          href="#"
                          className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                          role="menuitem"
                        >
                          Sign out
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="flex items-center h-7 bg-amber-400">
          <marquee width="100%">
            <div className="text-black">Diarvis BMD</div>
          </marquee>
        </div>
      </div>
    </>
  );
};

export default Header;

// {
//   dataUser.hasOwnProperty("NIM") ? (
//     <div className="block ml-4 text-white text-sm">
//       <div className="font-light text-sm">
//         {/* {Context.user.nama} */}
//         {dataUser.nama}
//       </div>
//       <div className="font-extralight text-xs">
//         {/* {Context.user.NIM} */}
//         {dataUser.NIM} (mahasiswa)
//       </div>
//     </div>
//   ) : (
//     <div className="block ml-4 text-white text-sm">
//       <div className="font-light text-sm">{dataUser.nama}</div>
//       <div className="font-extralight text-xs">{dataUser.NIP} (dosen)</div>
//     </div>
//   );
// }
