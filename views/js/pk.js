const urlParams = new URLSearchParams(window.location.search);
      let param = urlParams.get("pokemon");
      param == null ? (param = "lucario") : null;
      console.log(param);
      fetch(
        `http://localhost/phpeasy/api.php/pokemon?name=${param}`
      )
        .then((res) => res.json())
        .then((res) => {
          document.getElementById("sprite").setAttribute("src", res.sprite);
          document.getElementById("name").textContent = res.name;
          const ul = document.createElement("ul");
          res.moves.map((r) => {
            const li = document.createElement("li");
            li.textContent = r.move;
            li.setAttribute('id', r.id)   
            ul.appendChild(li);
          });

          const ul2 = document.createElement("ul");
          res.abilities.map((r) => {
            const li = document.createElement("li");
            li.textContent = r.ability;
            li.setAttribute('id', r.id) 
            ul2.appendChild(li);
          });

          const ul3 = document.createElement("ul");
          res.types.map((r) => {
            const li = document.createElement("li");
            li.textContent = r.type;
            li.setAttribute('id', r.id) 
            ul3.appendChild(li);
          });

          let moveAlling = document.getElementById("moves");
          let typeAlling = document.getElementById("types");
          let abilityAlling = document.getElementById("abilities");

          moveAlling.appendChild(ul);
          abilityAlling.appendChild(ul2);
          
          typeAlling.appendChild(ul3);
        })
        .catch((e) => console.log(e));