import React, { useState } from "react";
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
import { MdBook, MdSpaceDashboard } from "react-icons/md";
import { BsFillBoxFill } from "react-icons/bs";

const SidebarItem = ({ title, subItems, icon, to }) => {
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
          <Icon className="w-6 h-6 mr-2 text-gray-500 transition duration-75 " size="20" />
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

const NewSidebar = () => {
  const navigation = [
    {
      title: "Dashboard",
      icon: MdSpaceDashboard,
      subItems: [],
      to: "/",
    },
    {
      title: "Data Master",
      icon: BsFillBoxFill,
      subItems: [
        {
          title: "KIB B",
          icon: RiContactsLine,
          subItems: [],
          to: "/filter",
        },
        {
          title: "KIB E",
          icon: BiMessageSquareDetail,
          subItems: [],
          to: "/filter",
        },
      ],
      to: "#",
    },
    {
      title: "Pengajuan",
      to: "/materi",
      subItems: [], 
      icon: MdBook,
   },
   {
      title: "Penilaian",
      to: "/tugas",
      subItems: [],
      icon: AiFillFolder
   },
    {
      title: "Settings",
      icon: AiOutlineSetting,
      subItems: [],
      to: "/settings",
    },
  ];

  return (
    <aside
      id="logo-sidebar"
      className="fixed top-0 left-0 z-40 w-64 h-screen pt-36 transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
      aria-label="Sidebar"
    >
      <div className="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
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

export default NewSidebar

// export default function App() {
//   return (
//     <div className="flex">
//       <Sidebar />
//       <div className="flex-1">{/* Konten Utama */}</div>
//     </div>
//   );
// }
