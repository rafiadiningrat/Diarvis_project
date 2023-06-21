import React, { useEffect, useMemo, useState } from "react";
import axios from "axios";
import { useTable } from "react-table";
import { Carousel } from "flowbite-react";
import { BsChevronCompactLeft, BsChevronCompactRight } from "react-icons/bs";
import { RxDotFilled } from "react-icons/rx";

const TestPage = () => {
   const slides = [
     {
       url: "http://localhost:8000/storage/1/banner_margahayu.png",
     },
     {
       url: "http://localhost:8000/storage/2/bemkema.png",
     },
     {
       url: "http://localhost:8000/storage/3/MainMenu.png",
     },

     {
       url: 'http://localhost:8000/storage/43/Screenshot-(1).png',
     },
   ];

   const [currentIndex, setCurrentIndex] = useState(0);

   const prevSlide = () => {
     const isFirstSlide = currentIndex === 0;
     const newIndex = isFirstSlide ? slides.length - 1 : currentIndex - 1;
     setCurrentIndex(newIndex);
   };

   const nextSlide = () => {
     const isLastSlide = currentIndex === slides.length - 1;
     const newIndex = isLastSlide ? 0 : currentIndex + 1;
     setCurrentIndex(newIndex);
   };

   const goToSlide = (slideIndex) => {
     setCurrentIndex(slideIndex);
   };

  return (
    <>
      <footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
          <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
          <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
            © 2023{" "}
            <a href="https://flowbite.com/" class="hover:underline">
              ERASE-BMD
            </a>
            . Jurusan Teknik Komputer dan Informatika-POLBAN<br/>All Rights Reserved.
          </span>
        </div>
      </footer>
    </>
  );
};

export default TestPage;
