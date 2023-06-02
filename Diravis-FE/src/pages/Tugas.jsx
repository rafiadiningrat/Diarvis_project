import React from "react";
import { useState, useEffect } from "react";
import Home from "../components/Layout/Sidebar";
import Header from "../components/Layout/Header";
import { AiOutlineArrowRight } from "react-icons/ai";
import { Link, useNavigate } from "react-router-dom";

const Tugas = () => {
  const [task, setTask] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    fetch("http://localhost:8000/api/tugas")
      .then((res) => {
        return res.json();
      })
      .then((resp) => {
        setTask(resp.data);
        console.log("cik", resp.data);
      })
      .catch((err) => {
        console.log(err.message);
      });
  }, []);

  const loadDetails = (id) => {
    navigate("/details/" + id);
  };

  return (
    <>
      <div className="flex w-screen">
        <Home />
        <div className="flex flex-col w-screen">
          <Header name="Tugas" />
          <div className="gap-4 pl-10 pr-10 pt-10">
            {task &&
              task?.map((post) => (
                <div className="card card-side bg-white shadow-lg mb-7">
                  <div>
                    <div className="w-10 h-full bg-[#FF1F5A]" />
                  </div>
                  <div className="card-body">
                    <h2 className="card-title text-[#131313]">{post.judul}</h2>
                    <p className="text-base-100">{post.deskripsi}</p>
                    <div className="card-actions justify-end">
                      <button
                        onClick={() => loadDetails(post.id)}
                        className="btn btn-ghost text-white bg-[#0ba6ff] hover:bg-[#0087d5] font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2"
                      >
                        <p className="mr-2">Details</p>
                        <AiOutlineArrowRight size={16} />
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

export default Tugas;
