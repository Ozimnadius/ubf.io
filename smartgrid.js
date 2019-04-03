const smartgrid = require('smart-grid');

smartgrid('./css/layout', {
    mobileFirst: false,
    columns: 24,
    offset: "20px",
    outputStyle: "scss",
    container: {
        maxWidth: "975px",
        fields: "30px",
        containerWidth: "975px"
    },
    breakPoints: {
        lg: {
            width: "1199.99px",
            fields: "15px",
            containerWidth: "975px"
        },
        md: {
            width: "991.99px",
            fields: "15px",
            containerWidth: "320px"
        },
        sm: {
            width: "767.99px",
            fields: "15px",
            containerWidth: "320px"
        },
        xs: {
            width: "575.99px",
            fields: "15px",
            containerWidth: "320px"
        }
    },
});