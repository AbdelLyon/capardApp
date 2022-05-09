const userLinks = document.querySelectorAll(".user-link");
const userLinkContent = document.querySelectorAll("small");
const links = document.querySelectorAll(".link-container");
const title = document.querySelector("h1");

const createNode = ({ tagName, id, className, content }) => {
	const elem = document.createElement(tagName);
	elem.id = id;
	elem.className = className;
	elem.innerHTML = content;
	return elem;
};

const mouseEvent = (elem1, elem2) => {
	elem1.addEventListener('mouseenter', () => (elem2.style.display = 'block'));
	elem1.addEventListener('mouseleave', () => (elem2.style.display = 'none'));
};


const showLetters = (i, title, content) => {
	let timeOut;
	if (i < content.length) {
		title.innerHTML += content[i];
		timeOut = setTimeout(() => showLetters(i, title, content), Math.floor(Math.random() * (100 - 8) + 8));
		i++;
	} else clearTimeout(timeOut);
};

//display userLink
userLinks.forEach((link, i) => {
	if (userLinkContent[i].id) mouseEvent(link, userLinkContent[i]);
})

const displayLinkSubCategory = async () => {
	const response = await fetch('http://127.0.0.1:8000/home/api');
	const data = await response.json();

	links.forEach((link) => {
		for (const key in data) {
			if (data.hasOwnProperty.call(data, key)) {
				if (key === link.id) {

					const modalLinkProduct = createNode({
						tagname: "div",
						className: "modalLinkProduct",
						content: data[key].map(d => `<a class="link link-light" href="/products/${key}/${d.name}"> ${d.name} </a>`).join('')
					});

					link.append(modalLinkProduct);
					mouseEvent(link, modalLinkProduct)
				}
			}
		};
	});
}

//display title
setTimeout(() => showLetters(0, title, "La nîme'alerie Capard"), 500);

displayLinkSubCategory();

