import React, { useState, useEffect } from "react";
import {
  AiOutlineHome,
  AiOutlineUser,
  AiOutlineSetting,
  AiFillFolder,
} from "react-icons/ai";
import { BiMessageSquareDetail } from "react-icons/bi";
import { RiContactsLine } from "react-icons/ri";
import { IoIosArrowDown, IoIosArrowUp } from "react-icons/io";
import { Link, useLocation } from "react-router-dom";
import {
  MdBook,
  MdSpaceDashboard,
  MdDriveFileMoveOutline,
} from "react-icons/md";
import {
  BsFillBoxFill,
  BsFillClipboardDataFill,
  BsFillClipboardCheckFill,
} from "react-icons/bs";

const SidebarItem = ({ title, subItems, icon, to}) => {
  const [isExpanded, setIsExpanded] = useState(false);
  const location = useLocation();
  const Icon = icon;

  const handleToggle = () => {
    setIsExpanded(!isExpanded);
  };

  const handleClick = () => {
    if (subItems && subItems.length > 0) {
      handleToggle();
    }
  };

  const isActive = location.pathname === to;
  // const isActive= location.state.title === title;
  
  return (
    <li>
      <Link
        to={to}
        className={`flex items-center p-2 rounded-lg text-gray-600 ${
          isActive ? "bg-gray-200" : "hover:bg-gray-100"
        }`}
        onClick={handleClick}
      >
        {Icon && (
          <Icon
            className="w-6 h-6 mr-2 text-gray-500 transition duration-75 "
            size="20"
          />
        )}
        <span className="ml-2">{title}</span>
        {subItems && subItems.length > 0 && (
          <span className="ml-auto">
            {isExpanded ? <IoIosArrowUp /> : <IoIosArrowDown />}
          </span>
        )}
      </Link>
      {subItems && subItems.length > 0 && (
        <ul
          className={`ml-4 transition-all duration-300 ${
            isExpanded ? "max-h-full opacity-100" : "max-h-0 opacity-0 hidden"
          }`}
        >
          {subItems.map((item, index) => (
            <SidebarItem
              key={index}
              title={item.title}
              subItems={item.subItems}
              icon={item.icon}
              to={item.to}
            />
          ))}
        </ul>
      )}
    </li>
  );
};

const Sidebar = () => {
  const navigation = [
    {
      title: "Dashboard",
      icon: MdSpaceDashboard,
      subItems: [],
      to: "/",
      state: "",
    },
    {
      title: "Data Master",
      icon: BsFillBoxFill,
      subItems: [
        {
          title: "KIB B",
          icon: RiContactsLine,
          subItems: [],
          to: "/datamaster/kib-b/filter",
          state: "KIB B",
        },
        {
          title: "KIB E",
          icon: BiMessageSquareDetail,
          subItems: [],
          to: "/datamaster/kib-e/filter",
          state: "KIB E",
        },
      ],
      to: "#",
    },
    {
      title: "Pengusulan",
      to: "#",
       subItems: [
        {
          title: "KIB B",
          icon: RiContactsLine,
          subItems: [],
          to: "/pengusulan/kib-b",
          state: "KIB B",
        },
        {
          title: "KIB E",
          icon: BiMessageSquareDetail,
          subItems: [],
          to: "/pengusulan/kib-e",
          state: "KIB E",
        },
      ],
      icon: MdDriveFileMoveOutline,
      state: "",
    },
    {
      title: "Penilaian",
      to: "/penilaian",
      subItems: [],
      icon: BsFillClipboardDataFill,
      state: "",
    },
    {
      title: "Verifikasi",
      to: "/verifikasi",
      subItems: [],
      icon: BsFillClipboardCheckFill,
      state: "",
    },
    {
      title: "Settings",
      icon: AiOutlineSetting,
      subItems: [],
      to: "/settings",
      state: "",
    },
  ];

  return (
    <aside
      id="logo-sidebar"
      className="fixed top-0 left-0 z-40 w-64 h-screen pt-36 transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
      aria-label="Sidebar"
    >
      <div className="h-full px-3 pb-4 overflow-y-auto bg-white drop-shadow-md">
        <ul className="space-y-2 font-medium">
          {navigation.map((item, index) => (
            <SidebarItem
              key={index}
              title={item.title}
              subItems={item.subItems}
              icon={item.icon}
              to={item.to}
            />
          ))}
        </ul>
      </div>
    </aside>
  );
};

export default Sidebar;

//old sidebar

// import React, { useState, useEffect } from "react";
// import { HiMenuAlt3 } from "react-icons/hi";
// import { MdSpaceDashboard, MdBook } from "react-icons/md";
// import { BsFillBoxFill } from "react-icons/bs";
// import { AiOutlineUser, AiOutlineLogout, AiFillFolder } from "react-icons/ai";
// import { FiHelpCircle } from "react-icons/fi";
// import {
//   BsFileEarmarkPlus,
//   BsBook,
//   BsClipboardCheck,
//   BsClipboardPlus,
// } from "react-icons/bs";
// import { Link } from "react-router-dom";

// const Sidebar = () => {
//   const [currentPage, setCurrentPage] = useState("");

//   useEffect(() => {
//     const newPage = window.location.pathname;

//     setCurrentPage(newPage);
//   }, [setCurrentPage]);

//   let SidebarData;
//   SidebarData = [
//     { name: "Dashboard", link: "/", icon: MdSpaceDashboard },
//     { name: "Data Barang", link: "/filter", icon: BsFillBoxFill },
//     { name: "Pengajuan", link: "/materi", icon: MdBook },
//     { name: "Penilaian", link: "/tugas", icon: AiFillFolder },
//     {
//       name: "Verifikasi Penghapusan",
//       link: "/profile",
//       icon: AiOutlineUser,
//     },
//     { name: "Edit User", link: "/help", icon: AiOutlineUser, margin: true },
//     { name: "logout", link: "/login", icon: AiOutlineLogout },
//   ];

// const dataUser = JSON.parse(sessionStorage.getItem("user"));
// if (dataUser.hasOwnProperty("NIM") === true) {
//   menus = [
//     { name: "dashboard", link: "/", icon: MdOutlineDashboard },
//     { name: "materi", link: "/materi", icon: BsBook },
//     { name: "tugas", link: "/tugas", icon: BsClipboardCheck },
//     { name: "profile", link: "/profile", icon: AiOutlineUser },
//     { name: "help", link: "/help", icon: FiHelpCircle, margin: true },
//     { name: "logout", link: "/login", icon: AiOutlineLogout },
//   ];
// } else {
//   menus = [
//     { name: "dashboard", link: "/", icon: MdOutlineDashboard },
//     {
//       name: "input materi",
//       link: "/inputMateri",
//       icon: BsFileEarmarkPlus,
//     },
//     { name: "input tugas", link: "/inputTugas", icon: BsClipboardPlus },
//     { name: "tugas mahasiswa", link: "/tugasMahasiswa", icon: BsClipboardPlus },
//     { name: "profile", link: "/profile", icon: AiOutlineUser },
//     { name: "help", link: "/help", icon: FiHelpCircle, margin: true },
//     { name: "logout", link: "/login", icon: AiOutlineLogout },
//   ];
// }
//   return (
//     <>
//       <aside
//         id="logo-sidebar"
//         className="fixed top-0 left-0 z-40 w-64 h-screen pt-36 transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
//         aria-label="Sidebar"
//       >
//         <div className="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
//           <ul className="space-y-2 font-medium">
//             {SidebarData.map((item, index) => (
//               <li>
//                 <Link
//                   to={item.link}
//                   key={index}
//                   className={
//                     item.link === currentPage
//                       ? "flex items-center p-2 text-gray-600 rounded-lg dark:text-white bg-gray-100"
//                       : "flex items-center p-2 text-gray-500 rounded-lg dark:text-white hover:bg-gray-100"
//                   }
//                 >
//                   <div className="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
//                     {React.createElement(item.icon, { size: "20" })}
//                   </div>

//                   <span className="ml-3">{item.name}</span>
//                 </Link>
//               </li>
//             ))}
//           </ul>
//           <button type="button" class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
//                   <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
//                   <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>E-commerce</span>
//                   <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
//             </button>

//         </div>
//       </aside>
//     </>
//   );
// };

// export default Sidebar;
