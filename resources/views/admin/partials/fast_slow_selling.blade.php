<div class="col-lg-6">
    <div class="tabs-container">
        <ul class="nav nav-tabs right-title">
            <li class="title"><h3><i class="ion-flame font-lg text-danger"></i> 5 Hotest selling</h3></li>
            <li class="">
                <a data-toggle="tab" href="#tab-1" aria-expanded="false">
                    Today
                </a>
            </li>
            <li class="active">
                <a data-toggle="tab" href="#tab-2" aria-expanded="true">
                    Last week
                </a>
            </li>

            <li class="">
                <a data-toggle="tab" href="#tab-3" aria-expanded="true">
                    Last month
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane">
                <div class="panel-body">
                    <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

                    <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                        existence in this spot, which was created for the bliss of souls like mine.</p>

                    <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                        the present moment; and yet I feel that I never was a greater artist than now. When.</p>
                </div>
            </div>
            <div id="tab-2" class="tab-pane active">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>

                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>
            <div id="tab-3" class="tab-pane">
                <div class="panel-body">
                    <strong>WImk o</strong>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="tabs-container">
        <ul class="nav nav-tabs left-title">
            <li class="title"><h3><i class="ion-arrow-graph-down-left font-lg text-warning"></i> 5 Slow selling</h3></li>
            <li class="">
                <a data-toggle="tab" href="#stab-1" aria-expanded="false">
                    Today
                </a>
            </li>
            <li class="active">
                <a data-toggle="tab" href="#stab-2" aria-expanded="true">
                    Last week
                </a>
            </li>

            <li class="">
                <a data-toggle="tab" href="#stab-3" aria-expanded="true">
                    Last month
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="stab-1" class="tab-pane">
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th width="80%">Item name</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                    @for($i = 1; $i <= 5; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td> 
                                <span class="label font-15 label-info">MaryKay</span> 
                                <span class="label font-15 label-warning">Eye</span> 
                                <span class="font-bold">Blush</span> 
                            </td>
                            <td>60{{$i}}</td>
                        </tr>
                    @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="stab-2" class="tab-pane active">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>

                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>
            <div id="stab-3" class="tab-pane">
                <div class="panel-body">
                    <strong>WImk o</strong>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>

        </div>
    </div>
</div>