import React from "react";
import { useState, useEffect } from "react";
import Home from "../components/Layout/Sidebar";
import Header from "../components/Layout/Header";
import Swal from "sweetalert2";

const Materi = () => {
  const [task, setTask] = useState([]);
  
  useEffect(() => {
    fetch("http://localhost:8000/api/materi")
      .then((res) => {
        return res.json();
      })
      .then((resp) => {
        setTask(resp.data);
      })
      .catch((err) => {
        console.log(err.message);
      });
  }, []);

  const downloadHandler = (e) => {
    e.preventDefault();
    Swal.fire({
      icon: "success",
      title: "Download Materi Berhasil",
      text: "Materi berhasil didownload",
    });
  };

  return (
    <>
      <div className="flex w-screen">
        <Home />
        <div className="flex flex-col w-screen">
          <Header name="Materi" />
          <div className="gap-4 pl-10 pr-10 pt-10">
            {task &&
              task.map((materi) => (
                <div className="card card-side bg-white shadow-lg mb-7">
                  <div>
                    <div className="w-10 h-full bg-[#0ba6ff]" />
                  </div>
                  <div className="card-body">
                    <h2 className="card-title text-[#131313]">
                      {materi.minggu_ke} - {materi.judul}
                    </h2>
                    <p className="text-base-100">{materi.deskripsi}</p>
                    <div className="card-actions justify-end">
                      <button
                        className="btn bg-[#0ba6ff] text-white btn-ghost hover:bg-[#0087d5]"
                        onClick={downloadHandler}
                      >
                        Download
                      </button>
                    </div>
                  </div>
                </div>
              ))}
          </div>
        </div>
      </div>
    </>
  );
};

export default Materi;
