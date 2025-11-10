const lerp = (current, target, factor) => {
  return current * (1 - factor) + target * factor;
 }

 let mousePosition = {
  x: 0,
  y: 0,
 };

 window.addEventListener("mousemove", ({ pageX, pageY }) => {
  mousePosition.x = pageX;
  mousePosition.y = pageY;
 });

 const calculateDistance = (x1, y1, x2, y2) => {
  return Math.hypot(x1 - x2, y1 - y2);
 }


 export default class MagneticButton {
  constructor(domElement) {
    this.domElement = domElement;
    this.boundingClientRect = this.domElement.getBoundingClientRect();
    this.triggerRadius = this.domElement.offsetWidth / 2;
    this.interpolationFactor = 0.3;

    this.lerpingData = {
      x: { current: 0, target: 0 },
      y: { current: 0, target: 0 }
    };

    this.resize();
    this.render();
  }

  resize() {
    window.addEventListener("resize", () => {
      this.boundingClientRect = this.domElement.getBoundingClientRect();
    })
  }

  render() {
    const distanceFromMouseToElementCenter = calculateDistance(
      mousePosition.x,
      mousePosition.y,
      this.boundingClientRect.left + this.boundingClientRect.width / 2,
      this.boundingClientRect.top + this.boundingClientRect.height / 2
    )

    const screenDistanceToElementCenter = {
      x: this.boundingClientRect.left + this.boundingClientRect.width / 2,
      y: this.boundingClientRect.top + this.boundingClientRect.height / 2
    }

    let targetHolder = {
      x: 0,
      y: 0
    };

    if (distanceFromMouseToElementCenter < this.triggerRadius) {
      targetHolder.x = (mousePosition.x - screenDistanceToElementCenter.x);
      targetHolder.y = (mousePosition.y - screenDistanceToElementCenter.y);
    }

    this.lerpingData['x'].target = targetHolder.x;
    this.lerpingData['y'].target = targetHolder.y;

    for (const item in this.lerpingData) {
      this.lerpingData[item].current = lerp(this.lerpingData[item].current, this.lerpingData[item].target, this.interpolationFactor);
    }

    this.domElement.style.transform = `translate(${this.lerpingData['x'].current}px, ${this.lerpingData['y'].current}px)`

    window.requestAnimationFrame(() => this.render());
  }
 }

