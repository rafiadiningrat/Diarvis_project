import React from 'react';

function Footer(props) {
    return (
      <>
        {/* <div className="flex flex-col lg:ml-64 pt-[8.7rem] px-5 w-auto">
          <div className="block p-6 bg-white border border-gray-200 rounded-lg shadow"></div> */}
        {/* <footer class="flex justify-center bg-white rounded-lg shadow dark:bg-gray-900 mt-auto lg:ml-64 p-6">
          <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8"></div> */}
        <footer class="flex flex-col lg:ml-64 mt-auto px-5 w-auto">
          {/* <div class="block p-6 bg-white border border-gray-200 rounded-lg ">
            <div class="sm:flex sm:items-center sm:justify-between">
              <a
                href="https://flowbite.com/"
                class="flex items-center mb-4 sm:mb-0"
              >
                <img
                  src="/images/erase_logo_header.png"
                  class="h-12 mr-3"
                  alt="Flowbite Logo"
                />
              </a>
              <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                  <a href="#" class="mr-4 hover:underline md:mr-6 ">
                    About
                  </a>
                </li>
              </ul>
            </div>
          </div> */}
          <hr class="my-6 w-11/12 mx-10 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
          <span class="block text-sm pb-5 text-gray-500 sm:text-center dark:text-gray-400">
            © 2023{" "}
            <a href="https://flowbite.com/" class="hover:underline">
              ERASE-BMD
            </a>
            . Jurusan Teknik Komputer dan Informatika-POLBAN
            <br />
            All Rights Reserved.
          </span>
        </footer>
        {/* <footer class="mt-auto">
          <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
              © 2023{" "}
              <a href="https://flowbite.com/" class="hover:underline">
                ERASE-BMD
              </a>
              . Jurusan Teknik Komputer dan Informatika-POLBAN
              <br />
              All Rights Reserved.
            </span>
          </div>
        </footer> */}
      </>
    );
}

export default Footer;