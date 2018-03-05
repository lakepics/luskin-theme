@import 'partials/variables';
@import 'sections/page';


/* ############ contact-team.scss ############ */

// styles for 0up
#meet-the-team {
    .team {
        margin-bottom: 40px;
        min-height: 380px;
    }
    h3 {
        font-family: $semibold-sans-serif;
        font-size: 20px;
        color: #47718E;
        text-transform: uppercase;
        margin-bottom: 5px;
        margin-top: 15px;
    }

    h4 {
        margin-top: 10px;
        font-size: 18px;
    }

    img.team-img {
        float: left;
        margin-right: 20px;
        margin-bottom: 10px;
    }

    .team-title {
        font-family: $sans-serif;
        font-size: 16px;
    }
}

@media only screen and (max-width: 481px) {
    #meet-the-team {
        .team {
            min-height: 0px;
        }
    }
}
@media only screen and (min-width: 481px) and (max-width: 1155px) {
    #meet-the-team {
        .team {
            min-height: 525px;
        }
    }
}
// styles for 481up
@media only screen and (min-width: 481px) {}

// styles for 640up
@media only screen and (min-width: 640px) {}

// styles for 768up
@media only screen and (min-width: 768px) {}

// styles for 1030up
@media only screen and (min-width: 1030px) {}

// styles for 1240up
@media only screen and (min-width: 1240px) {}

// styles for 2x
@media only screen and (-webkit-min-device-pixel-ratio: 1.5),
only screen and (min--moz-device-pixel-ratio: 1.5),
only screen and (min-device-pixel-ratio: 1.5) {}
