import React, { useState, useEffect } from "react";
import {
  AiOutlineHome,
  AiOutlineUser,
  AiOutlineSetting,
  AiFillFolder,
  AiOutlineLogout,
} from "react-icons/ai";
import { BiMessageSquareDetail, BiUserCircle } from "react-icons/bi";
import { FaUser } from "react-icons/fa";
import { RiContactsLine } from "react-icons/ri";
import { IoIosArrowDown, IoIosArrowUp } from "react-icons/io";
import { Link, useLocation, useNavigate } from "react-router-dom";
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
import Swal from "sweetalert2";

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
  const navigate = useNavigate();
  const logoutHandler = () => {
    Swal.fire({
      title: "Apakah anda yakin?",
      text: "Anda akan logout!",
      icon: "warning",
      reverseButtons: true,
      confirmButtonText: "Ya, logout!",
      cancelButtonText: "Tidak",
      showCancelButton: true,
    }).then((result) => {
      if (result.isConfirmed) {
        navigate("/login");
      }
    });
  }
  const dataUser = JSON.parse(sessionStorage.getItem("user"));
  // console.log(dataUser.kode_group);
  let sidebarMenu;
  if (dataUser.kode_group === 2) {
    sidebarMenu = [
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
            to: "/datamaster/kib-b",
          },
          {
            title: "KIB E",
            icon: BiMessageSquareDetail,
            subItems: [],
            to: "/datamaster/kib-e",
          },
        ],
        to: "#",
      },
      {
        title: "Pengusulan",
        to: "/pengusulan/filter",
        subItems: [],
        icon: MdDriveFileMoveOutline,
      },
      {
        title: "Laporan",
        icon: BsFillBoxFill,
        subItems: [
          {
            title: "Berita Acara",
            icon: RiContactsLine,
            subItems: [],
            to: "/berita-acara/filter",
          },
          {
            title: "Penghapusan",
            icon: BiMessageSquareDetail,
            subItems: [],
            to: "/laporan-penghapusan/filter",
          },
        ],
        to: "#",
      },
      {
        title: "Profil",
        icon: BiUserCircle,
        subItems: [],
        to: `/profile/${dataUser.id_user}`,
      },
    ];
  } else if (dataUser.kode_group === 3) {
    sidebarMenu = [
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
            to: "/datamaster/kib-b",
          },
          {
            title: "KIB E",
            icon: BiMessageSquareDetail,
            subItems: [],
            to: "/datamaster/kib-e",
          },
        ],
        to: "#",
      },
      {
        title: "Verifikasi",
        to: "/verifikasi/filter",
        subItems: [],
        icon: BsFillClipboardCheckFill,
      },
      {
        title: "Laporan",
        icon: BsFillBoxFill,
        subItems: [
          {
            title: "Berita Acara",
            icon: RiContactsLine,
            subItems: [],
            to: "/berita-acara/filter",
          },
          {
            title: "Penghapusan",
            icon: BiMessageSquareDetail,
            subItems: [],
            to: "/laporan-penghapusan/filter",
          },
        ],
        to: "#",
      },
      {
        title: "Profil",
        icon: BiUserCircle,
        subItems: [],
        to: `/profile/${dataUser.id_user}`,
      },
    ];
  } else if (dataUser.kode_group === 4) {
    sidebarMenu = [
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
            to: "/datamaster/kib-b",
          },
          {
            title: "KIB E",
            icon: BiMessageSquareDetail,
            subItems: [],
            to: "/datamaster/kib-e",
          },
        ],
        to: "#",
      },
      {
        title: "Penilaian",
        to: "/penilaian/filter",
        subItems: [],
        icon: BsFillClipboardDataFill,
      },
      {
        title: "Laporan",
        icon: BsFillBoxFill,
        subItems: [
          {
            title: "Berita Acara",
            icon: RiContactsLine,
            subItems: [],
            to: "/berita-acara/filter",
          },
          {
            title: "Penghapusan",
            icon: BiMessageSquareDetail,
            subItems: [],
            to: "/laporan-penghapusan/filter",
          },
        ],
        to: "#",
      },
      {
        title: "Profil",
        icon: BiUserCircle,
        subItems: [],
        to: `/profile/${dataUser.id_user}`,
      },
    ];
  } else {
  sidebarMenu = [
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
          to: "/datamaster/kib-b/filter",
        },
        {
          title: "KIB E",
          icon: BiMessageSquareDetail,
          subItems: [],
          to: "/datamaster/kib-e/filter",
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
          to: "/pengusulan/kib-b/filter",
        },
        {
          title: "KIB E",
          icon: BiMessageSquareDetail,
          subItems: [],
          to: "/pengusulan/kib-e/filter",
        },
      ],
      icon: MdDriveFileMoveOutline,
    },
    {
      title: "Penilaian",
      to: "#",
      subItems: [
        {
          title: "KIB B",
          icon: RiContactsLine,
          subItems: [],
          to: "/penilaian/kib-b/filter",
        },
        {
          title: "KIB E",
          icon: BiMessageSquareDetail,
          subItems: [],
          to: "/penilaian/kib-e/filter",
        },
      ],
      icon: BsFillClipboardDataFill,
    },
    {
      title: "Verifikasi",
      to: "#",
      subItems: [
        {
          title: "KIB B",
          icon: RiContactsLine,
          subItems: [],
          to: "/verifikasi/kib-b/filter",
        },
        {
          title: "KIB E",
          icon: BiMessageSquareDetail,
          subItems: [],
          to: "/verifikasi/kib-e/filter",
        },
      ],
      icon: BsFillClipboardCheckFill,
    },
    {
      title: "Laporan",
      icon: BsFillBoxFill,
      subItems: [
        {
          title: "Berita Acara",
          icon: RiContactsLine,
          subItems: [],
          to: "/berita-acara/filter",
        },
        {
          title: "Penghapusan",
          icon: BiMessageSquareDetail,
          subItems: [],
          to: "/laporan-penghapusan/filter",
        },
      ],
      to: "#",
    },
    {
      title: "Data User",
      icon: FaUser,
      subItems: [],
      to: "/data-user",
    },
    {
      title: "Profil",
      icon: BiUserCircle,
      subItems: [],
      to: `/profile/${dataUser.id_user}`,
    },
  ];
  }

  return (
    <aside
      id="logo-sidebar"
      className="fixed top-0 left-0 z-40 w-64 h-screen pt-36 transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
      aria-label="Sidebar"
    >
      <div className="h-full px-3 pb-4 overflow-y-auto bg-white drop-shadow-md">
        <ul className="space-y-2 font-medium">
          {sidebarMenu.map((item, index) => (
            <SidebarItem
              key={index}
              title={item.title}
              subItems={item.subItems}
              icon={item.icon}
              to={item.to}
            />
          ))}
          <button
            className="flex items-center justify-start w-full mt-10 rounded-lg hover:bg-gray-100"
            onClick={() => logoutHandler()}
          >
            <div className="flex items-center px-2 py-2 space-x-2 font-medium p-2 rounded-lg text-gray-600">
              <AiOutlineLogout
                className="w-6 h-6 mr-[0.6rem] text-gray-500 transition duration-75 "
                size="20"
              />
              <span>Logout</span>
            </div>
          </button>
        </ul>
      </div>
    </aside>
  );
};

export default Sidebar;
