const search = document.getElementById("search")
const results = document.getElementById("results")
const userRole = parseInt(search.dataset.role || "0")

fetch("/search.xml")
    .then(data => data.text())
    .then(data => {
        const parser = new DOMParser()
        const xmlDoc = parser.parseFromString(data, "text/xml")
        const urls = xmlDoc.getElementsByTagName("url")
        const pages = []

        for (let i = 0; i < urls.length; i++) {
            const loc = urls[i].getElementsByTagName("loc")[0]?.textContent
            const title = urls[i].getElementsByTagName("title")[0]?.textContent
            const minRole = parseInt(urls[i].getElementsByTagName("min_role")[0]?.textContent || "0")
            if (loc && title && minRole <= userRole) {
                const cleanUrl = loc.replace(/^https?:\/\/[^/]+/, "")
                pages.push({ url: cleanUrl || "/", title })
            }
        }

        search.addEventListener("input", function () {
            const query = this.value.toLowerCase().trim()

            if (!query) {
                results.innerHTML = ""
                results.classList.remove("show")
                return
            }

            const filtered = pages.filter(r =>
                r.title.toLowerCase().includes(query) ||
                r.url.toLowerCase().includes(query)
            ).slice(0, 10)

            if (filtered.length === 0) {
                results.innerHTML = '<div class="search-dropdown-empty">Ничего не найдено</div>'
            } else {
                results.innerHTML = filtered.map(r =>
                    `<a href="${r.url}" class="search-dropdown-item">${highlightMatch(r.title, query)}</a>`
                ).join("")
            }

            results.classList.add("show")
        })
    })

function highlightMatch(text, query) {
    const idx = text.toLowerCase().indexOf(query)
    if (idx === -1) return escapeHtml(text)
    return (
        escapeHtml(text.slice(0, idx)) +
        "<strong>" + escapeHtml(text.slice(idx, idx + query.length)) + "</strong>" +
        escapeHtml(text.slice(idx + query.length))
    )
}

function escapeHtml(text) {
    const div = document.createElement("div")
    div.textContent = text
    return div.innerHTML
}

document.addEventListener("click", function (e) {
    if (!search.contains(e.target) && !results.contains(e.target)) {
        results.classList.remove("show")
    }
})
