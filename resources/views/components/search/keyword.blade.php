    <form action="{{ route('cafe.search.keyword') }}" method="GET">
      @csrf
      <div class="relative justify-center flex w-full">
        <input id="myInput" type="text" name="keyword" class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:ring-0 focus:border-lime-400 focus:border-2 focus:text-neutral-700 focus:outline-none" placeholder="" aria-label="Search" aria-describedby="button-addon1" required />
        <!--Search button-->
        <button class="relative z-[2] flex items-center rounded-r bg-lime-500 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-lime-700 hover:shadow-lg focus:bg-lime-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-lime-800 active:shadow-lg" type="submit" id="button-addon1" data-te-ripple-init data-te-ripple-color="light">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
          </svg>
        </button>
      </div>
    </form>
    <script>
      function updatePlaceholder() {
        var inputElement = document.getElementById('myInput');
        var windowWidth = window.innerWidth;

        if (windowWidth <= 768) {
          inputElement.placeholder = 'Search...';
        } else {
          inputElement.placeholder = 'Cafe Name, City, Keyword...';
        }
      }

      updatePlaceholder();

      window.addEventListener('resize', updatePlaceholder);
    </script>