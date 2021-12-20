let VinylShop = (function () {

    function hello() {
        console.log('The Vinyl Shop JavaScript works! 🙂');
    }

    /**
     * Show a Noty toast.
     * @param {object} obj
     * @param {string} [obj.type='success'] - background color ('success' | 'error '| 'info' | 'warning')
     * @param {string} [obj.text='...'] - text message
     */
    function toast(obj) {
            // if no object specified, create a new empty object
        let toastObj = obj || {};
        new Noty({
            layout: 'topRight',
            timeout: 3000,
            modal: false,
                // if no type specified, use 'success'
            type: toastObj.type || 'success',
                // if no text specified, use '...'
            text: toastObj.text || '...',
        }).show();
    }

    return {
        hello: hello,    // publicly available as: VinylShop.hello()
        toast: toast,   // publicly available as: VinylShop.toast()
    };
})();

export default VinylShop;
