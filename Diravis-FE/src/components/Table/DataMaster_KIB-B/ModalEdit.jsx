import React, { useState, useEffect, useRef } from "react";
import { FaTimes } from "react-icons/fa";

const Modal_Edit_Data_KIB_B = ({ isOpen, onClose, onSave, data }) => {
  const [editedData, setEditedData] = useState({ name: "", age: "" });
  const modalRef = useRef(null);

  useEffect(() => {
    if (data) {
      setEditedData(data);
    }
  }, [data]);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setEditedData((prevData) => ({ ...prevData, [name]: value }));
  };

  const handleSave = () => {
    onSave(editedData);
  };

  const handleCloseModal = () => {
    onClose();
  };

  const handleOutsideClick = (e) => {
    if (modalRef.current && !modalRef.current.contains(e.target)) {
      onClose();
    }
  };

  useEffect(() => {
    if (isOpen) {
      document.addEventListener("mousedown", handleOutsideClick);
    } else {
      document.removeEventListener("mousedown", handleOutsideClick);
    }
    return () => {
      document.removeEventListener("mousedown", handleOutsideClick);
    };
  }, [isOpen]);

  if (!isOpen) return null;

  return (
    <>
      <div className="fixed inset-0 bg-black opacity-50 z-50"></div>
      <div className="fixed inset-0 flex items-center justify-center z-[60]">
        <div className="bg-white rounded-lg p-6 relative" ref={modalRef}>
          <button
            className="absolute top-2 right-2 text-gray-500"
            onClick={handleCloseModal}
          >
            <FaTimes />
          </button>
          <div className="flex flex-col space-y-3">
            <input
              type="text"
              name="name"
              value={editedData.name}
              onChange={handleInputChange}
              className="border border-gray-300 rounded-md px-3 py-2"
              placeholder="Nama"
            />
            <input
              type="text"
              name="age"
              value={editedData.age}
              onChange={handleInputChange}
              className="border border-gray-300 rounded-md px-3 py-2"
              placeholder="Umur"
            />
            <div className="flex justify-end">
              <button
                className="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mr-2"
                onClick={handleSave}
              >
                Save
              </button>
              <button
                className="bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400"
                onClick={handleCloseModal}
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Modal_Edit_Data_KIB_B;
