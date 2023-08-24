@props(['teamid'])

{{-- <template id="card" class="!bg-gray-500"> --}}
{{--    <div data-role="card" draggable="true" --}}
{{--        class="w-full px-4 py-2 overflow-hidden text-sm bg-white border border-gray-200 cursor-pointer select-none line-clamp-3 rounded-md"> --}}
{{--    </div> --}}
{{-- </template> --}}
<!-- index.html -->
<template id="card" class="!bg-gray-500">
    <div data-role="card" draggable="true"
        class="w-full px-4 pb-4 overflow-hidden text-sm bg-white border border-gray-200 hei cursor-pointer select-none line-clamp-3 rounded-md">
        <div class="flex gap-1 items-center prio-type-container">
            <div class="card-priority relative">
                <!-- Priority label will be added here -->
            </div>
            <div class="card-type"></div>
        </div>
        <h3 class="card-name pb-2"></h3>
        <p class="card-description"></p>
        <p class="card-estimated-date flex justify-end pr-1"></p> <!-- New element for estimated finish date -->
    </div>
</template>

@pushOnce('component')
    <Script>
        const cardTemplate = document.querySelector("template#card");


        class Card {

            constructor(id, name, board, description, priority, type, typeColor, estimatedDate) {
                this.board = board;
                this.name = name;
                this.description = description;
                this.priority = priority;
                this.type = type;
                this.typeColor = typeColor;
                this.estimatedDate = estimatedDate;
                console.log(typeColor)

                const content = cardTemplate.content.cloneNode(true);

                const node = document.createElement("div");
                node.append(content);


                this.ref = node.children[0];

                /* -----
                -----   Target the card element
                  ------------- */
                const cardNameElement = this.ref.querySelector(".card-name");
                const cardPriorityElement = this.ref.querySelector(".card-priority");

                cardNameElement.textContent = name;

                // Determine label text and color based on priority
                let labelText = "";
                let labelColorClass = "";

                if (priority === 1) {
                    labelText = "Low Priority";
                    labelColorClass = "bg-green-500";
                } else if (priority === 2) {
                    labelText = "Medium Priority";
                    labelColorClass = "bg-yellow-500";
                } else if (priority === 3) {
                    labelText = "High Priority";
                    labelColorClass = "bg-red-500";
                }
                // Create and style the priority label
                const priorityLabel = document.createElement("span");
                priorityLabel.textContent = labelText;
                if (labelColorClass !== "") {
                    priorityLabel.classList.add("priority-label", "text-white" , labelColorClass);
                }

                // Append the priority label to the card element
                cardPriorityElement.appendChild(priorityLabel);

                // Append the type label to the card element
                const cardTypeElement = this.ref.querySelector(".card-type");
                const typeLabel = document.createElement("span");
                typeLabel.textContent = type;
                typeLabel.classList.add('text-white', 'py-1', 'px-3', 'font-bold', 'rounded');
                typeLabel.style.backgroundColor = typeColor;
                cardTypeElement.appendChild(typeLabel);


                if (priority > 0) {
                    const prioTypeContainer = this.ref.querySelector('.prio-type-container');
                    prioTypeContainer.classList.add('mt-3', "mb-1");
                }


                // Check if estimatedDate exists before adding to the card
                if (estimatedDate) {
                    const parsedDate = new Date(estimatedDate);
                    const options = {
                        month: 'long',
                        day: 'numeric'
                    };
                    const formattedDate = parsedDate.toLocaleDateString('en-US', options);

                    const estimatedDateElement = document.createElement("p");
                    estimatedDateElement.textContent = formattedDate;
                    estimatedDateElement.classList.add("card-estimated-date", "mt-2", "text-xs", "text-gray-600");

                    const calendarIcon = document.createElement("span");
                    calendarIcon.textContent = "📅"; // Calendar icon
                    calendarIcon.classList.add("ml-1", "cursor-pointer");

                    estimatedDateElement.appendChild(calendarIcon);

                    this.ref.querySelector(".card-estimated-date").appendChild(estimatedDateElement);
                }



                this.ref.dataset.id = id;
                this.ref.setAttribute('draggable', (id != null));



                this.ref.addEventListener("dragstart", () => {
                    this.board.IS_EDITING = true;
                    this.ref.classList.add("is-dragging");
                    this.ref.classList.toggle("!bg-gray-500");
                });

                this.ref.addEventListener("click", () => {
                    const board_id = this.board.ref.dataset.id;
                    const card_id = this.ref.dataset.id;
                    window.location.href =
                        `{{ url('team/' . $teamid . '/board/${board_id}/card/${card_id}/view') }}`;
                });

                this.ref.addEventListener("dragend", () => {
                    this.ref.classList.remove("is-dragging");
                    this.ref.setAttribute('draggable', false);
                    this.ref.classList.toggle("!bg-gray-500");

                    const board_id = this.board.ref.dataset.id;

                    ServerRequest.post(`{{ url('team/' . $teamid . '/board/${board_id}/card/reorder') }}`, {
                            column_id: this.ref.closest("div[data-role='column']").dataset.id,
                            middle_id: this.ref.dataset.id,
                            bottom_id: this.ref.nextElementSibling?.dataset?.id || null,
                            top_id: this.ref.previousElementSibling?.dataset?.id || null,
                        })
                        .then((response) => {
                            this.board.IS_EDITING = false;
                            this.ref.setAttribute('draggable', true);
                            console.log(response.data);
                        });
                })
            }



            setId(id) {
                this.ref.dataset.id = id;
                this.ref.setAttribute('draggable', true);
            }

            mountTo(column) {
                column.ref.querySelector("section > div#card-container").append(this.ref);
                this.board = column.board;
            }

        }
    </Script>
@endPushOnce
