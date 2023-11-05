<?php 
session_start();

if($_SESSION["phone"] == "") {
   header( "location: ./login" );
}

mysqli_close($server);
?>

<style type="text/css">
 .img_game {
    width: 100%;
}

    .zoom:hover {
      -ms-transform: scale(1.1); /* IE 9 */
      -webkit-transform: scale(1.1); /* Safari 3-8 */
      transform: scale(1.1); 
  }
A:link {
text-decoration:none;
}
A:visited {
text-decoration:none;
}

</style>

<div align="center" class="navbar" style="width: 100%; background-color: #101010;">
    <div class="row">
        <a class="zoom col-3" class="active"  id="casino">
            <img src="./images/casino-ico-1.png" class="img-fluid">
            <span class="d-block">คาสิโน</span>
        </a>

        <a class="zoom col-3"  id="slot">
            <img src="./images/slot-ico.png" class="img-fluid">
            <span class="d-block">สล็อต</span>
        </a>

        <a class="zoom col-3"  id="fishing">
            <img src="./images/fish-ico-1.png" class="img-fluid">
            <span class="d-block">ยิงปลา</span>
        </a>
         <a class="zoom col-3"  id="fishing">
            <img src="./images/soccer-ico-1.png" class="img-fluid">
            <span class="d-block">ฟุตบอล</span>
        </a>
    </div>
</div>

<!-- <div align="center" class="navbar" style="    width: 100%;
background-color: #101010;">
<a  class="zoom" class="active"  id="casino">
    <img src="assets/images/gr/icon/casino-ico-1.png" width="220" height="137"><br>
    คาสิโน สด
</a>

<a  class="zoom"  id="slot">
    <img src="assets/images/gr/icon/slot-ico.png" width="220"  height="137"><br>
    สล็อต ออนไลน์
</a>

<a  class="zoom"  id="fishing">
    <img src="assets/images/gr/icon/fish-ico-1.png" width="220"  height="137"><br>
    ยิงปลา/เกมส์
</a>
</div> -->

    <br><br><br>
    <div align="center" class="container">   
        <div class="row text-light" id="myRow">

        </div>

    </div>
    <br><br>
    <script>

        (async () => {
            // const gameAll = document.getElementById("gameAll");

            const gameList = await fetch("./DataManager.php?gameList=all").then((r) => r.json());
            const { GameCode, List } = gameList;

            let dataList = [];

            const myRow = document.getElementById("myRow");

            const slot = document.getElementById("slot");
            const casino = document.getElementById("casino");
            const fishing = document.getElementById("fishing");

            async function RemoveOldList() {
                // while (gameAll.lastElementChild) {
                //     gameAll.removeChild(gameAll.lastElementChild);
                // }
                while (myRow.lastElementChild) {
                    myRow.removeChild(myRow.lastElementChild);
                }
            }

            const sorting = [
            {
                type: "slot",
                childs: ["pg", "joker", "kingsmaker", "pragmatric"]
            },
            {
                type: "casino",
                childs: ["sa", "sexy", "ag", "dg"]
            }
            ];

            await ShowListGame("casino");
            let stateSelect = "";
            slot.onclick = async function () {
                stateSelect = "slot";
                await RemoveOldList();
                await ShowListGame("slot");
            }

            casino.onclick = async function () {
                stateSelect = "casino";
                await RemoveOldList();
                await ShowListGame("casino");
            }

            fishing.onclick = async function () {
                stateSelect = "fishing";
                await RemoveOldList();
                await ShowListGame("fishing");
            }

            async function ShowListGame(show) {

                let ListSorting = [];

                if(show === "casino" || show === "slot") {
                    const { type, childs } = sorting.find((t) => t.type === show);

                    let itemTemp1 = [];
                    let itemTemp2 = [];

                    childs.forEach((c, i) => {
                        const item = List.find((f) => f.game.toLowerCase() === c.toLowerCase());
                        if(item) itemTemp1[i] = item;
                    });

                    List.forEach((l) => {
                        const item = childs.find((c) => l.game.toLowerCase() === c.toLowerCase());
                        if(!item) itemTemp2.push(l);
                    });
                    ListSorting = [...itemTemp1, ...itemTemp2]
                } else {
                    ListSorting = List;
                }

                ListSorting.filter((f) => f.type.toLocaleLowerCase().search(show) !== -1)
                .forEach((g, i) => {
                    const { game, logo, type, msg, name, isOpen } = g;
                        // const li = document.createElement("li"); // <li></li>
                        const img = document.createElement("img"); // <img />
                        const br = document.createElement("br"); // <br>

                        const divColumn = document.createElement("div");
                        const spanText = document.createElement("p");


                      //  เร็วๆนี้ ปิดปรับปรุง
                        // if(msg === "ปิดปรับปรุง") spanText.classList.add("text-danger");
                        // if(msg === "เร็วๆนี้") spanText.classList.add("text-warning");
                        // if(msg === "ปิดปรับปรุง" || msg === "เร็วๆนี้") spanText.innerText = `(${msg})`;

                        if(isOpen === "0") {
                            img.style.filter = 'grayscale(100%)';
                            img.style.opacity = 'opacity: 0.5';
                            spanText.classList.add("text-danger");
                            spanText.innerText = ` (${msg})`;
                        } 
                        

                        divColumn.classList.add("col-4");
                        divColumn.innerText = name;



                        divColumn.appendChild(spanText);
                        divColumn.appendChild(img);
                        // divColumn.style.textDecoration = 'underline';

                        const oldImage = logo.toString().split("/");
                        const serveImage = `https://grandgame888.com/game/images/betflix/${oldImage[oldImage.length-1]}`;
                        img.src = serveImage; // <img src="{{link}}" />
                        //img.width = '140';
                        img.classList.add("img_game","zoom");

                        divColumn.insertAdjacentElement('afterbegin', br);
                        divColumn.insertAdjacentElement('afterbegin', img);
                        divColumn.id = `subRow_${i}`;
                        myRow.appendChild(divColumn);


                        const find = GameCode.find((name) => name === game);

                        divColumn.onclick = async function () {
                            const removeColId = parseInt(this.id.toString().split("subRow_")[1]);

                        // li.onclick = async function () {
                            const requestGame = await fetch(`./DataManager.php?requestGame=${game}`)
                            .then((r) => r.json());
                            const { listGame, list } = requestGame;


                            for (var clIndex = 0; clIndex < myRow.children.length; clIndex++) {
                                const nodeOfRow = myRow.children[clIndex];
                                nodeOfRow.classList.remove("col-4");
                                nodeOfRow.classList.add("col-12");

                                // if(clIndex !== removeColId) {
                                    nodeOfRow.innerText = "";
                                    while (nodeOfRow.lastElementChild) {
                                        nodeOfRow.removeChild(nodeOfRow.lastElementChild);
                                    }
                                // }
                            }

                            const mySubRow = document.createElement("div");
                            mySubRow.classList.add("row");


                            if (listGame) {

                                for (let i = 0; i < divColumn.children.length; i++) {
                                    const child = divColumn.children[i];
                                    console.log(child.tagName);
                                    if (child.tagName === "DIV") {
                                        while (child.lastElementChild) {
                                            child.removeChild(child.lastElementChild);
                                        }
                                    }



                                }


                                list.forEach((gList, i) => {
                                    const mySubColumn = document.createElement("div");
                                    mySubColumn.insertAdjacentElement('beforebegin', br);
                                    mySubColumn.insertAdjacentElement('beforebegin', br);
                                    mySubColumn.insertAdjacentElement('beforebegin', br);

                                    // const ol = document.createElement("ol");
                                    // ol.id = `ol_id${i}`
                                    const provider = gList.provider.toLocaleLowerCase();
                                    const code = gList.code.toLocaleLowerCase();
                                    const olName = gList.name.toLocaleLowerCase();
                                    const img = gList.img;


                                    const imgElement = document.createElement("img");


                                    if(gList.img.search("icon") !== -1) {
                                        const url = "https://img.betflix777.com";
                                        const fullPath = `${url}${img}`;
                                        imgElement.src = fullPath;
                                    } else{
                                        // console.log({img})
                                        imgElement.src = img;
                                    }

                                    //imgElement.style.width = '100%';
                                    imgElement.classList.add("img_game");    

                                    const a = document.createElement("a");

                                    a.textContent = olName;


                                    mySubColumn.classList.add("col-4","text-center");

                                    mySubColumn.insertAdjacentElement('beforeend', imgElement);
                                    mySubColumn.insertAdjacentElement('beforeend', document.createElement("br"));

                                    mySubColumn.insertAdjacentElement('beforeend', a);
                                    mySubColumn.insertAdjacentElement('beforeend', document.createElement("br"));
                                    mySubColumn.insertAdjacentElement('beforeend', document.createElement("br"));
                                    mySubColumn.insertAdjacentElement('beforeend', document.createElement("br"));


                                    a.onclick = async function() {
                                       await ActiveLink();
                                   }

                                   imgElement.onclick = async function() {
                                    await ActiveLink();
                                }

                                async function ActiveLink() {
                                    const requestGame = await fetch("./show_game.php", {
                                        method: "POST",
                                        headers: {
                                            'content-type': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            provider,
                                            gamecode: code
                                        })
                                    })
                                    .then((r) => r.json());
                                    const { status } = requestGame;
                                    if (status === 'success') {
                                        const error_code = requestGame.error_code;
                                        const msg = requestGame.msg;
                                        const launch_url = requestGame.data.launch_url;
                                        window.location = launch_url;
                                        // setTimeout(() => {
                                        //     window.open(launch_url);
                                        // })
                                        
                                    }
                                }

                                mySubRow.appendChild(mySubColumn);
                                divColumn.appendChild(mySubRow);
                                    // divColumn.appendChild(a);

                                    // ol.appendChild(a);
                                    // li.appendChild(ol);
                                });
} else {

    const requestGame = await fetch("./show_game.php", {
        method: "POST",
        headers: {
            'content-type': 'application/json'
        },
        body: JSON.stringify({
            provider: list,
            gamecode: 'casino'
        })
    })
    .then((r) => r.json());
    const { status } = requestGame;
    if (status === 'success') {
        const error_code = requestGame.error_code;
        const msg = requestGame.msg;
        const launch_url = requestGame.data.launch_url;
        
                                     window.location = launch_url;
                                    //  setTimeout(() => {
                                    //     window.open(launch_url);
                                    // })
                                     
                                     
                                 }
                                 window.setTimeout(async() => await ShowListGame(stateSelect), 100);

                             }
                         }
                     });
}

})();

</script>

