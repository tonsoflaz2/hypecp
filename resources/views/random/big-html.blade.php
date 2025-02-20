<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Long HTML Page</title>
    <script src="https://unpkg.com/htmx.org@2.0.3"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        header, footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            background-color: #444;
            margin: 0;
        }
        nav ul li {
            margin: 0 1rem;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        section {
            padding: 1rem;
            margin: 1rem auto;
            max-width: 800px;
        }
        article {
            margin-bottom: 2rem;
        }
        article img {
            max-width: 100%;
            height: auto;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table {
            width: 100%;
        }
        .row > div {
            vertical-align: top;
            border-top: 1px solid lightgray;
            padding: 5px;
        }
        
        .extra-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out, padding 0.3s ease-out;
            padding: 0;
        }
        .expanded {
            max-height: 200px; /* Adjust to fit content */
            padding: 10px 0;
        }
    </style>

    <script>
        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("expand-button")) {
                let row = event.target.closest(".row");
                let extraContent = row.querySelector(".extra-content");

                // Toggle expansion with a smooth transition
                if (extraContent.classList.contains("expanded")) {
                    extraContent.classList.remove("expanded");
                    event.target.textContent = "Expand";
                } else {
                    extraContent.classList.add("expanded");
                    event.target.textContent = "Collapse";
                }
            }
        });
    </script>
</head>
<body>

<header>
    <h1>Welcome to the Long HTML Page</h1>
    <p>Scroll through to explore the content</p>
</header>

<nav>
    <ul>
        <li><a href="#section1">Section 1</a></li>
        <li><a href="#section2">Section 2</a></li>
        <li><a href="#section3">Section 3</a></li>
        <li><a href="#section4">Section 4</a></li>
    </ul>
</nav>

<h2>The large interactive Table</h2>

<div style="margin:40px; border: 1px solid lightgray;">
    <div class="table">
        @for ($i=0; $i<1000; $i++)
            @include('random.big-html-row')
        @endfor
    </div>
</div>

@for ($i=0; $i<500; $i++)

<section id="section1">
    <h2>Section 1: Introduction</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel sapien non nunc pharetra suscipit. Proin vitae vehicula enim. Sed nec lorem et augue consequat luctus. Vivamus tristique nisi vel bibendum mattis.</p>
    <article>
        <h3>Subsection 1.1</h3>
        <p>Nunc vel dui ultricies, feugiat nulla id, malesuada risus. Donec in neque ut urna bibendum scelerisque. Fusce nec nunc ut erat facilisis vehicula.</p>
    </article>
    <article>
        <h3>Subsection 1.2</h3>
        <img src="https://via.placeholder.com/600x400" alt="Placeholder Image">
        <p>Quisque at tincidunt nunc. Donec dignissim lorem a risus fringilla, at gravida velit malesuada.</p>
    </article>
</section>

<section id="section2">
    <h2>Section 2: Gallery</h2>
    <div class="grid">
        <div class="card">
            <img src="https://via.placeholder.com/200" alt="Placeholder">
            <p>Card 1 description</p>
        </div>
        <div class="card">
            <img src="https://via.placeholder.com/200" alt="Placeholder">
            <p>Card 2 description</p>
        </div>
        <div class="card">
            <img src="https://via.placeholder.com/200" alt="Placeholder">
            <p>Card 3 description</p>
        </div>
        <div class="card">
            <img src="https://via.placeholder.com/200" alt="Placeholder">
            <p>Card 4 description</p>
        </div>
    </div>
</section>

<section id="section3">
    <h2>Section 3: Contact Us</h2>
    <form>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="5" required></textarea><br><br>

        <button type="submit">Submit</button>
    </form>
</section>

<section id="section4">
    <h2>Section 4: FAQ</h2>
    <details>
        <summary>What is this page about?</summary>
        <p>This is a sample HTML page with multiple sections for demonstration purposes.</p>
    </details>
    <details>
        <summary>How can I use this template?</summary>
        <p>You can use this template for practice or as a base for creating your own pages.</p>
    </details>
    <details>
        <summary>Can I customize this?</summary>
        <p>Yes, feel free to modify the content and styles as needed.</p>
    </details>
</section>

@endfor

<footer>
    <p>&copy; 2025 Long HTML Page. All rights reserved.</p>
</footer>

</body>
</html>